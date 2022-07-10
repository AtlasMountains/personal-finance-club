<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-partials._head />
    @if (isset($styles))
        {{ $styles }}
    @endif
</head>

<body x-data="{ 'darkMode': false }" :class="darkMode ? 'bg-dark' : 'bg-gray-200'" class="antialiased" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))">

    <div :class="{ 'dark': darkMode === true }">
        <div class="flex flex-col h-screen bg-gray-200 dark:bg-slate-900">
            <div id="navbar">
                <x-partials._nav />
            </div>

            <main class="flex-1">
                {{ $slot }}
            </main>
            <div class="w-full text-center dark:bg-slate-900">
                <x-partials._footer />
            </div>
        </div>
    </div>

    @if (isset($scripts))
        {{ $scripts }}
    @endif
</body>

</html>
