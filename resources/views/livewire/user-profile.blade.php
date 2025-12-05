<div class="max-w-2xl mx-auto mt-10 p-8 bg-neutral-900 rounded-xl shadow border border-neutral-700">
    <div class="flex items-center gap-6">
        <img
            src="{{ $user->profile_photo_url ?? asset('default-avatar.png') }}"
            alt="Avatar"
            class="rounded-full w-12 h-12 object-cover shadow inline-block mr-2"
        />
        <div class="font-bold text-2xl text-neutral-200">{{ $user->name }}</div>
        <div class="text-neutral-400">{{ $user->email }}</div>
        @if($user->description)
            <div class="mt-3 text-neutral-300 whitespace-pre-line">
                {{ $user->description }}
            </div>
        @endif
        </div>
    </div>

    @if($user->pictures->count())
        <div class="mt-8">
            <div class="font-semibold text-neutral-200 mb-4 text-lg">
                {{ __('Twoje zdjęcia') }}:
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach($user->pictures as $picture)
                    <button
                        type="button"
                        wire:click="openModal('{{ asset('storage/' . $picture->path) }}')"
                        class="block group focus:outline-none"
                    >
                        <img
                            src="{{ asset('storage/' . $picture->path) }}"
                            alt="User Photo"
                            class="rounded-lg object-cover w-full aspect-square shadow group-hover:opacity-80 transition"
                        >
                    </button>
                @endforeach
            </div>

            @if($modalImage)
                <div class="fixed inset-0 bg-black/80 flex items-center justify-center z-50"
                     wire:click.self="closeModal">
                    <div class="rounded-xl border shadow-lg p-4 sm:p-8 w-full max-w-lg sm:max-w-2xl flex flex-col items-center
                        bg-neutral-100 dark:bg-neutral-900
                        border-neutral-200 dark:border-neutral-700
                        relative">

                        <!-- Close X always in the same place -->
                        <button
                            wire:click="closeModal"
                            class="absolute top-4 right-4 text-neutral-500 dark:text-neutral-400 text-3xl hover:text-red-500 transition focus:outline-none"
                            title="Zamknij"
                        >&times;</button>

                        <img
                            src="{{ $modalImage }}"
                            alt="Zdjęcie użytkownika"
                            class="w-full max-h-[50vh] sm:max-h-[32rem] object-cover rounded-xl transition-all"
                            style="aspect-ratio: 1/1; object-fit: cover;"
                        >

                    </div>
                </div>
            @endif

        </div>
    @endif

</div>
