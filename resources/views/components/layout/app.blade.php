<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <x-partials._head/>
</head>

<body
  x-data="{'darkMode': false}"
  :class="darkMode ? 'bg-dark' : 'bg-gray-200'"
  class="antialiased"
  x-init="
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode',JSON.stringify(value)))"
>

<div :class="{'dark' : darkMode === true}">
  <div class="flex flex-col h-screen bg-gray-200 dark:bg-dark">
    <div id="navbar">
      <x-partials._nav/>
    </div>

    <main class="flex-1">
      {{ $slot }}
    </main>

    <x-partials._footer/>

  </div>
</div>
</body>
</html>
