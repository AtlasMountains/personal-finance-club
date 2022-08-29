<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script defer src="{{ asset('js/app.js') }}"></script>

  <title>{{ config('app.name') }}</title>
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

  <!-- ====== Error 404 Section Start -->
  <section class="flex flex-col items-center h-screen bg-primary-500 dark:bg-dark">
    <h2 class="pt-24 font-bold text-white mb-2 text-[50px] sm:text-[80px] md:text-[100px] leading-none ">
      404
    </h2>
    <!--suppress SpellCheckingInspection -->
    <h4 class="text-white font-semibold text-[22px] leading-tight mb-3">
      {{ __('Oops! That page can’t be found') }}
    </h4>
    <p class="mb-8 text-lg text-white">
      {{ __('The page you are looking for, it maybe deleted') }}
    </p>
    <x-navigation.link route="{{route('home')}}"
                       class="px-6 py-6 bg-white border-4 rounded-lg shadow-lg border-secondary-500 dark:bg-slate-700">
      {{ __('Go To Home') }}
    </x-navigation.link>
  </section>
  <!-- ====== Error 404 Section End -->
</div>
</body>

</html>
