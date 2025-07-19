<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Czy jestem ładna?</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(120deg, #fff4bc 0%, #ffc9d0 48%, #cf9aff 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex flex-col">
<!-- Header/Navbar -->
<!-- Header/Navbar -->
<header class="flex items-center justify-between w-full max-w-7xl mx-auto px-8 py-6 text-base">
    <div class="flex items-center gap-1">
        <div class="rounded-full bg-white/70 w-8 h-8 flex items-center justify-center">
            <!-- Example: Heart emoji for logo -->
            <span class="text-2xl">💖</span>
        </div>
        <span class="font-semibold text-lg ml-2">czyjestemladna.pl</span>
    </div>
    @if (Route::has('login'))
        <nav class="flex gap-6 items-center">
            @auth
                <a href="{{ url('/dashboard') }}" class="hover:underline font-semibold">Panel</a>
            @else
                <a href="{{ route('login') }}" class="hover:underline font-semibold">Zaloguj się</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hover:underline font-semibold">Rejestracja</a>
                @endif
            @endauth
        </nav>
    @endif
</header>
<!-- Main Content -->
<main class="flex-1 flex flex-col items-center justify-center px-4 w-full">
    <!-- HERO SECTION: text and image side by side on desktop, stacked on mobile -->
    <div class="w-full max-w-5xl flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-24 mx-auto mt-8 mb-12">
        <!-- LEFT: Text & CTA -->
        <div class="flex-1 flex flex-col items-center lg:items-start text-center lg:text-left">
            <h1 class="text-[clamp(2.6rem,6vw,5rem)] font-bold leading-tight text-black mb-4" style="letter-spacing:-0.01em;">
                Poznaj kogoś wyjątkowego!
            </h1>
            <div class="text-lg text-gray-800 max-w-xl mb-8 font-normal">
                <span>Poznawaj nowych ludzi!</span><br>
                Oceniaj innych i daj się ocenić!<br>
                Zabaw się w sympatycznej społeczności i poczuj się pięknie.<br>
                Głosuj klikając <span class="font-semibold text-pink-500">❤️</span> lub <span class="font-semibold text-blue-500">❌</span> — i sprawdź jak widzą Cię inni!
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-8">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="bg-black text-white text-lg px-8 py-3 rounded-2xl font-semibold shadow-lg hover:bg-gray-900 hover:scale-105 active:scale-95 transition-all duration-150">
                        Przejdź do panelu
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-black text-white text-lg px-8 py-3 rounded-2xl font-semibold shadow-lg hover:bg-gray-900 hover:scale-105 active:scale-95 transition-all duration-150">
                        Zaloguj się
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="bg-white/80 text-black text-lg px-8 py-3 rounded-2xl font-semibold border border-white/80 shadow-md hover:bg-white hover:scale-105 active:scale-95 transition-all duration-150">
                            Zarejestruj się
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- RIGHT: Image (beside text on desktop, below text on mobile) -->
        <div class="flex-1 flex justify-center lg:justify-end w-full">
            <img
                src="/images/welcome_page_picture1.png"
                alt="Troje uśmiechniętych ludzi z sercem"
                class="rounded-2xl shadow-xl border border-white/70 max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl w-full h-auto"
                style="background:rgba(255,255,255,0.2)"
            >
        </div>
    </div>

    <!-- INFO-LIST below hero section (always centered and full width) -->
    <div class="max-w-2xl w-full mx-auto">
        <ul class="space-y-6 text-base text-gray-700 mb-16">
            <li>
                <span class="align-middle text-xl mr-2">💬</span>
                Oceniaj profile użytkowników – polub tych, którzy Ci się podobają.
            </li>
            <li>
                <span class="align-middle text-xl mr-2">💛</span>
                Zbieraj polubienia i sprawdź, jak ocenili Cię inni!
            </li>
            <li>
                <span class="align-middle text-xl mr-2">🔒</span>
                Bezpieczna, anonimowa i pozytywna społeczność – poznaj kogoś fajnego!
            </li>
        </ul>
    </div>

    <footer class="mt-2 text-xs text-gray-500 text-center w-full">
        Made with ❤️ in Poland • <a href="#" class="underline hover:text-pink-600">Polityka prywatności</a>
    </footer>
</main>

</body>
</html>
