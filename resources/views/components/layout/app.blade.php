<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="{{ asset('css/app.css')}}">
  <script defer src="{{ asset('js/app.js') }}"></script>

  <title>{{config('app.name')}}</title>
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
  <div class="bg-gray-200 dark:bg-dark">
    <div id="navbar">
      <!-- ====== Navbar Section Start -->
      <header
        x-data="{navbarOpen: false}"
        class="
        w-full flex items-center justify-center
        py-4 mb-4 bg-white
        md:py-0 lg:mt-0 dark:bg-slate-700">
        <div class="flex w-4/5 mx-4 items-center justify-between relative">
          <nav class="flex w-full px-4 items-center justify-start md:justify-between">
            <div>
              <button
                @click="navbarOpen = !navbarOpen"
                :class="navbarOpen && 'navbarTogglerActive' "
                id="navbarToggler"
                class="block absolute right-4 top-1/2 -translate-y-1/2 md:hidden focus:ring-2 ring-primary px-3 py-[6px] rounded-lg bg-secondary">
                  <span
                    class="relative w-[30px] h-[2px] my-[6px] block bg-dark"></span>
                <span
                  class="relative w-[30px] h-[2px] my-[6px] block bg-dark"></span>
                <span
                  class="relative w-[30px] h-[2px] my-[6px] block bg-dark"></span>
              </button>
              <div
                :class="!navbarOpen && 'hidden' "
                id="navbarCollapse"
                class="
                absolute py-5 top-16 right-4 left-4 z-50
                flex flex-col items-center justify-center text-3xl
                bg-white border-2 border-secondary rounded-lg shadow-2xl
                md:block md:w-full md:static md:border-0 md:bg-white md:shadow-none
                dark:bg-slate-700">

                <ul class="block w-full text-center md:flex md:items-center md:justify-center">

                  <li
                    class="py-3 flex items-center justify-center md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white">
                    <x-navigation.link route="{{ route('home') }}">
                      {{__('Home') }}
                    </x-navigation.link>
                  </li>

                  <li
                    class="py-3 flex items-center justify-center md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white">
                    <x-navigation.link route="{{ route('blog') }}">
                      {{__('Blog') }}
                    </x-navigation.link>
                  </li>

                  @guest
                    <li
                      class="py-3 flex items-center justify-center md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white md:hidden">
                      <x-navigation.link route="{{ route('login') }}">
                        {{__('Login') }}
                      </x-navigation.link>
                    </li>

                    <li
                      class="py-3 flex items-center justify-center md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white md:hidden">
                      <x-navigation.link route="{{ route('register') }}">
                        {{__('Sign Up') }}
                      </x-navigation.link>
                    </li>
                  @endguest
                  @auth
                    <li
                      class="py-3 flex items-center justify-center md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white md:hidden">
                      <x-navigation.link route="{{ route('user.dashboard') }}">
                        {{__('dashboard') }}
                      </x-navigation.link>
                    </li>
                  @endauth
                </ul>
              </div>
            </div>
            <div class="flex items-center justify-end">

              <!-- Toggle switch begins -->
              <div class="flex justify-end items-center space-x-2 px-5">
                <span class="dark:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                   xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span>
                <label for="toggle"
                       class="w-9 h-5 flex items-center bg-gray-300 rounded-full p-1 cursor-pointer duration-300 ease-in-out dark:bg-gray-600">
                  <span
                    class="toggle-dot bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out dark:translate-x-3">
                  </span>
                </label>
                <span class="dark:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                   xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></span>
                <input id="toggle" type="checkbox" class="hidden" :value="darkMode"
                       @change="darkMode = !darkMode"/>
              </div>
              <!-- Toggle switch ends -->
              @guest
                <x-navigation.link route="{{route('login')}}" class="hidden md:inline">
                  {{__('Login') }}
                </x-navigation.link>
                <x-navigation.link route="/register" class="hidden md:inline">
                  {{__('Sign Up') }}
                </x-navigation.link>
              @endguest
              @auth
                <li>
                  <a href="{{ route('user.dashboard') }}"
                     class="text-base font-medium text-white bg-primary rounded-lg py-3 px-7 hover:bg-opacity-90">
                    {{__('Dashboard') }}
                  </a>
                </li>
              @endauth
            </div>
          </nav>
        </div>
      </header>
      <!-- ====== Navbar Section End -->
    </div>

    <main>
      {{$slot}}
    </main>

  </div>
</div>
</body>
</html>
