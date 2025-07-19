<div class="flex flex-col items-center justify-center min-h-[300px] sm:min-h-[500px] w-full px-2">
    @if ($currentPicture)
        <div class="rounded-xl border shadow-lg p-4 sm:p-8 w-full max-w-lg sm:max-w-2xl flex flex-col items-center
                    bg-neutral-100 dark:bg-neutral-900
                    border-neutral-200 dark:border-neutral-700">
            <div class="flex gap-4 sm:gap-6 mb-4 sm:mb-6 w-full items-center">
                <img
                    src="{{ $currentPicture->user->profile_photo_url }}"
                    alt="Avatar"
                    class="rounded-full w-10 h-10 sm:w-12 sm:h-12 object-cover shadow"
                >
                <div class="font-bold text-lg sm:text-2xl text-neutral-900 dark:text-neutral-200">
                    <a href="{{ route('user.profile', $currentPicture->user) }}"
                       class="font-bold text-lg sm:text-2xl text-neutral-900 dark:text-neutral-200 hover:underline">
                        {{ $currentPicture->user->name ?? 'Unknown' }}
                    </a>
                </div>
                <div class="text-neutral-500 dark:text-neutral-400 text-sm sm:text-base">
                    {{ $currentPicture->created_at->diffForHumans() }}
                </div>
            </div>

            <img
                src="{{ asset('storage/' . $currentPicture->path) }}"
                alt="Picture"
                class="w-full max-h-[50vh] sm:max-h-[32rem] object-cover rounded-xl mb-4 sm:mb-6 transition-all"
                style="aspect-ratio: 1/1; object-fit: cover;"
            >

            <div class="flex gap-6 sm:gap-12 mt-2 sm:mt-4">
                <!-- Skip Button (Red X) -->
                <button
                    wire:click="skip"
                    class="flex items-center justify-center w-14 h-14 sm:w-20 sm:h-20 rounded-full
           bg-neutral-100 dark:bg-neutral-800
           border-2 border-red-500 dark:border-red-600
           text-red-600 dark:text-red-600
           hover:bg-red-500 hover:dark:bg-red-600 hover:text-white
           transition"
                    title="Skip"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 sm:w-16 sm:h-16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.3 5.71a1 1 0 0 0-1.41 0L12 10.59 7.11 5.7A1 1 0 1 0 5.7 7.11l4.89 4.89-4.89 4.89a1 1 0 1 0 1.41 1.41l4.89-4.89 4.89 4.89a1 1 0 0 0 1.41-1.41l-4.89-4.89 4.89-4.89a1 1 0 0 0 0-1.41z"/>
                    </svg>
                </button>

                <!-- Like Button (Pink Heart) -->
                <button
                    wire:click="like"
                    class="flex items-center justify-center w-14 h-14 sm:w-20 sm:h-20 rounded-full
           bg-neutral-100 dark:bg-neutral-800
           border-2 border-pink-500 dark:border-pink-600
           text-pink-600 dark:text-pink-600
           hover:bg-pink-500 hover:dark:bg-pink-600 hover:text-white
           transition"
                    title="Like"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 sm:w-16 sm:h-16" viewBox="0 0 24 24" fill="currentColor">
                        <g transform="translate(1.8,2) scale(0.85)">
                            <path d="M12 21c-.55 0-1.08-.23-1.46-.63C6.2 16.27 2 12.36 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.86-4.2 7.77-8.54 11.88-.38.4-.91.62-1.46.62z"/>
                        </g>
                    </svg>
                </button>

            </div>
        </div>
    @else
        <div class="text-center text-neutral-500 dark:text-neutral-400 text-lg sm:text-xl mt-10 sm:mt-20">
            Brak zdjęć do wyświetlenia!
        </div>
    @endif
</div>
