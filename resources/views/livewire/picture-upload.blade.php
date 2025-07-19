<div class="flex items-center gap-4 p-4
            bg-neutral-100 dark:bg-neutral-800
            rounded-xl mb-6
            border border-neutral-200 dark:border-neutral-700">
    <form wire:submit.prevent="save" class="flex items-center gap-4 w-full">
        <label
            class="cursor-pointer px-4 py-2 rounded
                   bg-blue-600 hover:bg-blue-700
                   text-white font-semibold transition"
        >
            <input
                type="file"
                wire:model="photo"
                accept="image/*"
                class="hidden"
            >
            Wybierz zdjęcie
        </label>
        <span class="text-neutral-700 dark:text-neutral-300 text-sm">
            {{ $photo ? $photo->getClientOriginalName() : 'Nie przesłano pliku' }}
        </span>

        @error('photo')
        <span class="text-red-500 font-medium">{{ $message }}</span>
        @enderror

        <button
            type="submit"
            class="px-4 py-2 rounded
                   bg-emerald-600 hover:bg-emerald-700
                   text-white font-semibold transition"
        >
            Prześlij
        </button>
    </form>

    @if (session()->has('message'))
        <div class="ml-4 text-green-700 dark:text-green-400 font-medium">
            {{ session('message') }}
        </div>
    @endif
</div>
