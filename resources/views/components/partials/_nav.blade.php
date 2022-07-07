<header x-data="{ navbarOpen: false }"
    class="flex items-center justify-center w-full py-4 bg-white md:py-0 lg:mt-0 dark:bg-slate-700">
    <div class="relative flex items-center justify-between w-4/5 mx-4">
        <nav class="flex items-center justify-start w-full px-4 md:justify-between">
            <div>
                <button @click="navbarOpen = !navbarOpen" :class="navbarOpen && 'navbarTogglerActive'" id="navbarToggler"
                    class="block absolute right-0 top-1/2 -translate-y-1/2
                md:hidden focus:ring-2 ring-primary px-3 py-[6px] rounded-lg bg-secondary">

                    <span class="relative w-[30px] h-[2px] my-[6px] block bg-dark"></span>
                    <span class="relative w-[30px] h-[2px] my-[6px] block bg-dark"></span>
                    <span class="relative w-[30px] h-[2px] my-[6px] block bg-dark"></span>
                </button>
                <div :class="!navbarOpen && 'hidden'" id="navbarCollapse"
                    class="absolute z-50 flex flex-col items-center justify-center py-5 text-3xl bg-white border-2 rounded-lg shadow-2xl top-16 right-4 left-4 border-secondary md:block md:w-full md:static md:border-0 md:bg-white md:shadow-none dark:bg-slate-700">

                    <ul class="block w-full text-center md:flex md:items-center md:justify-center">

                        <li
                            class="flex items-center justify-center py-3 md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white">
                            <x-navigation.link route="{{ route('home') }}">
                                {{ __('Home') }}
                            </x-navigation.link>
                        </li>

                        @guest
                            <li
                                class="flex items-center justify-center py-3 md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white md:hidden">
                                <x-navigation.link route="{{ route('login') }}">
                                    {{ __('Login') }}
                                </x-navigation.link>
                            </li>

                            <li
                                class="flex items-center justify-center py-3 md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white md:hidden">
                                <x-navigation.link route="{{ route('register') }}">
                                    {{ __('Sign Up') }}
                                </x-navigation.link>
                            </li>
                        @endguest
                        @auth
                            <li
                                class="flex items-center justify-center py-3 md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white md:hidden">
                                <x-navigation.link class="focus:outline-red-500"
                                    route="{{ route('user.account.index') }}">
                                    {{ __('dashboard') }}
                                </x-navigation.link>
                            </li>

                            <li
                                class="flex items-center justify-center py-3 md:py-0 hover:bg-gray-200 dark:hover:bg-slate-600 md:hover:bg-white md:hidden">
                                <form action="{{ route('user.logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="px-2 text-base font-medium text-dark md:hidden hover:text-secondary dark:text-white dark:hover:text-secondary">
                                        {{ __('logout') }}
                                    </button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="flex items-center justify-end">

                <!-- Toggle switch begins -->
                <div class="flex items-center justify-end px-5 space-x-2">
                    <span class="dark:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg></span>
                    <label for="toggle"
                        class="flex items-center h-5 p-1 duration-300 ease-in-out bg-gray-300 rounded-full cursor-pointer w-9 dark:bg-gray-600">
                        <span
                            class="w-4 h-4 duration-300 ease-in-out transform bg-white rounded-full shadow-md toggle-dot dark:translate-x-3">
                        </span>
                    </label>
                    <span class="dark:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg></span>
                    <input id="toggle" type="checkbox" class="hidden" :value="darkMode"
                        @change="darkMode = !darkMode" />
                </div>
                <!-- Toggle switch ends -->
                @guest
                    <x-navigation.link route="{{ route('login') }}" class="hidden md:inline">
                        {{ __('Login') }}
                    </x-navigation.link>
                    <x-navigation.link route="{{ route('register') }}" class="hidden md:inline">
                        {{ __('Sign Up') }}
                    </x-navigation.link>
                @endguest
                @auth

                    <a href="{{ route('user.account.index') }}"
                        class="py-3 text-base font-medium text-white transition rounded-lg bg-primary px-7 hover:bg-secondary focus:bg-secondary">
                        {{ __('Dashboard') }}
                    </a>

                    <form action="{{ route('user.logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="hidden px-2 text-base font-medium text-dark md:inline hover:text-secondary dark:text-white dark:hover:text-secondary">
                            <span class="flex justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span class="block">{{ __('logout') }}</span>
                            </span>
                        </button>
                    </form>
                @endauth
            </div>
        </nav>
    </div>
</header>
