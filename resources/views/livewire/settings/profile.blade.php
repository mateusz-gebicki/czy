<?php

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public ?string $description = null;
    public ?TemporaryUploadedFile $profile_photo = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->description = $user->description;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'description' => ['nullable', 'string', 'max:500'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
        ]);

        logger('DEBUG profile_photo', [
            'isset' => isset($this->profile_photo),
            'is_instance' => $this->profile_photo instanceof TemporaryUploadedFile,
            'value' => $this->profile_photo,
        ]);

        if ($this->profile_photo) {
            $path = $this->profile_photo->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        Auth::setUser($user->fresh());

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
};
?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6" enctype="multipart/form-data">
            {{-- Profile Photo --}}
            <div class="flex items-center gap-6">
                @if ($profile_photo instanceof TemporaryUploadedFile)
                    <img src="{{ $profile_photo->temporaryUrl() }}" alt="Preview"
                         class="rounded-full w-24 h-24 object-cover">
                @else
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile Photo"
                         class="rounded-full w-24 h-24 object-cover">
                @endif

                <div>
                    <input type="file" wire:model="profile_photo" accept="image/*" class="block text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100"
                    >
                    @error('profile_photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name"/>

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email"/>

                @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer"
                                       wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Profile Description --}}
            <flux:textarea
                wire:model="description"
                :label="__('Profile Description')"
                rows="3"
                placeholder="{{ __('Tell us something about yourself...') }}"
            />
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form/>
    </x-settings.layout>
</section>
