<x-layouts.app :title="__('Dashboard')">
    <div class="mb-6">
        @livewire('picture-upload')
    </div>

    <div class="flex flex-col items-center justify-center min-h-[60vh]">
        @livewire('picture-box')
    </div>
</x-layouts.app>
