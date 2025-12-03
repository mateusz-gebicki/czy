<div class="flex items-center gap-4 p-4
    bg-white dark:bg-neutral-800
    rounded-xl mb-6
    border border-neutral-200 dark:border-neutral-700
    shadow-sm transition-colors duration-300">
    <form wire:submit.prevent="save" class="flex items-center gap-4 w-full">
        <label
            class="cursor-pointer px-4 py-2 rounded-lg
                border border-pink-400 bg-white text-pink-600 font-semibold
                hover:bg-pink-50 hover:border-pink-500
                dark:bg-pink-600 dark:text-white dark:border-pink-700 dark:hover:bg-pink-700 dark:hover:border-pink-600
                transition"
        >
            <input
                type="file"
                wire:model="photo"
                accept="image/*"
                class="hidden"
            >
            Wybierz zdjęcie
        </label>
        <span class="text-neutral-700 dark:text-neutral-300 text-sm font-medium">
            {{ $photo ? $photo->getClientOriginalName() : 'Nie przesłano pliku' }}
        </span>

        @error('photo')
        <span class="text-red-500 font-medium">{{ $message }}</span>
        @enderror

        <button
            type="submit"
            class="px-4 py-2 rounded-lg
                bg-emerald-500 text-white font-semibold
                hover:bg-emerald-600
                dark:bg-transparent dark:text-emerald-400 dark:border dark:border-emerald-400 dark:hover:bg-emerald-800 dark:hover:text-white
                transition"
        >
            Prześlij
        </button>
    </form>

    @if (session()->has('message'))
        <div class="ml-4 text-emerald-700 dark:text-emerald-400 font-medium">
            {{ session('message') }}
        </div>
    @endif
</div>
