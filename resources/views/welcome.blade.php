<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Nieuws Project') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">
<header class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <a href="/" class="text-xl font-semibold text-gray-800">Nieuws Project</a>
        <nav class="flex items-center gap-4 text-sm">
            <a href="" class="text-gray-600 hover:text-gray-900">Nieuws</a>
            <a href="" class="text-gray-600 hover:text-gray-900">FAQ</a>
            <a href="" class="text-gray-600 hover:text-gray-900">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Inloggen</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">Registreren</a>
                @endif
            @endauth
        </nav>
    </div>
</header>

<main>
    <section class="bg-indigo-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Welkom bij {{ config('app.name', 'Nieuws Project') }}</h1>
            <p class="text-xl text-indigo-100 max-w-2xl mx-auto">Jouw centrale plek voor nieuws, veelgestelde vragen en
                contact met ons team.</p>
            <div class="mt-8 flex justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-md hover:bg-indigo-50">Naar
                        dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-md hover:bg-indigo-50">Inloggen</a>
                    <a href="{{ route('register') }}"
                       class="px-6 py-3 border-2 border-white text-white font-semibold rounded-md hover:bg-indigo-500">Registreren</a>
                @endauth
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Nieuws</h2>
                    <p class="text-gray-600 mb-4">Blijf op de hoogte van het laatste nieuws en updates van onze
                        community.</p>
                    <a href="" class="text-indigo-600 hover:text-indigo-800 font-medium">Bekijk
                        nieuws &rarr;</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">FAQ</h2>
                    <p class="text-gray-600 mb-4">Vind snel antwoorden op veelgestelde vragen, georganiseerd per
                        categorie.</p>
                    <a href="{{ route('faq.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Bekijk
                        FAQ &rarr;</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Contact</h2>
                    <p class="text-gray-600 mb-4">Heb je een vraag? Neem contact met ons op via het
                        contactformulier.</p>
                    <a href="{{ route('contact') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Contacteer
                        ons &rarr;</a>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-white border-t border-gray-100 py-6 text-center text-gray-500 text-sm">
    &copy; {{ date('Y') }} {{ config('app.name', 'Nieuws Project') }}
</footer>
</body>
</html>
