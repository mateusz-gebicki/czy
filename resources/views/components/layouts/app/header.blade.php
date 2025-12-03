<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <style>
        .gradient-bg {
            background: linear-gradient(120deg, #fff4bc 0%, #ffc9d0 48%, #cf9aff 100%);
        }
        .header-gradient {
            background: linear-gradient(90deg, #fff7e0 0%, #fce5fa 100%);
            border-bottom: 1px solid #ffd6ea;
        }
        .sidebar-gradient {
            background: linear-gradient(90deg, #fff4bc 0%, #ffe5f8 100%);
            border-right: 1px solid #ffd6ea;
        }
        /* Only apply gradients in light mode! */
        .dark .gradient-bg,
        .dark .header-gradient,
        .dark .sidebar-gradient {
            background: unset !important;
            background-color: #171717 !important;
            border-color: #27272a !important;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg dark:bg-zinc-800 transition-colors duration-500">
<flux:header container class="header-gradient dark:border-zinc-700 dark:bg-zinc-900 transition-colors duration-500">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <a href="{{ route('dashboard') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
        <x-app-logo />
    </a>

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
            {{ __('Strona główna') }}
        </flux:navbar.item>
    </flux:navbar>

    <flux:spacer />

    <!-- Desktop User Menu -->
    <flux:dropdown position="top" align="end">
        <flux:profile
            class="cursor-pointer"
            :initials="auth()->user()->initials()"
        />

        <flux:menu>
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>
            <flux:menu.separator />

            <flux:menu.radio.group>
                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>

<!-- Mobile Menu -->
<flux:sidebar stashable sticky class="lg:hidden sidebar-gradient dark:border-zinc-700 dark:bg-zinc-900 transition-colors duration-500">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
        <x-app-logo />
    </a>

    <flux:navlist variant="outline">
        <flux:navlist.group :heading="__('Platform')">
            <flux:navlist.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Strona główna') }}
            </flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    <flux:spacer />
</flux:sidebar>

{{ $slot }}

@fluxScripts
</body>
</html>
