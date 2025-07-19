<div class="max-w-2xl mx-auto mt-10 p-8 bg-neutral-900 rounded-xl shadow border border-neutral-700">
    <div class="flex items-center gap-6">
        <img
            src="{{ $user->profile_photo_url }}"
            alt="Avatar"
            class="rounded-full w-20 h-20 object-cover shadow"
        >
        <div>
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
                    <a href="{{ asset('storage/' . $picture->path) }}" target="_blank" class="block group">
                        <img
                            src="{{ asset('storage/' . $picture->path) }}"
                            alt="User Photo"
                            class="rounded-lg object-cover w-full aspect-square shadow group-hover:opacity-80 transition"
                        >
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
