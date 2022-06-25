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

<body class="antialiased">
<div id="navbar">
    <!-- ====== Navbar Section Start -->
    <header
        x-data="{navbarOpen: false}"
        class="bg-white w-full flex items-center py-2 my-4 min-h-[20px]">
        <div class="container">
            <div class="flex -mx-4 items-center justify-between relative">
                <div class="flex px-4 justify-between items-center w-full">
                    <div>
                        <button
                            @click="navbarOpen = !navbarOpen"
                            :class="navbarOpen && 'navbarTogglerActive' "
                            id="navbarToggler"
                            class=" block absolute right-4 top-1/2 -translate-y-1/2 lg:hidden focus:ring-2 ring-primary px-3 py-[6px] rounded-lg ">
                            <span
                                class="relative w-[30px] h-[2px] my-[6px] block bg-body-color"></span>
                            <span
                                class="relative w-[30px] h-[2px] my-[6px] block bg-body-color"></span>
                            <span
                                class="relative w-[30px] h-[2px] my-[6px] block bg-body-color"></span>
                        </button>
                        <nav
                            :class="!navbarOpen && 'hidden' "
                            id="navbarCollapse"
                            class=" absolute py-5 px-6 bg-white shadow rounded-lg max-w-[250px] w-full right-4 top-full
                                    lg:max-w-full lg:block lg:w-full lg:static lg:shadow-none ">
                            <ul class="block lg:flex">
                                <li>
                                    <a
                                        href="{{route('home')}}"
                                        class="text-base font-medium text-dark hover:text-primary py-2 flex
                                        lg:inline-flex lg:ml-12">
                                        {{__('Home') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}"
                                       class=" text-base font-medium text-dark hover:text-primary py-2 lg:inline-flex flex lg:ml-12 ">
                                        {{__('Blog') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/unknown"
                                       class=" text-base font-medium text-dark hover:text-primary py-2 lg:inline-flex flex lg:ml-12 ">
                                        {{__('Unknown') }}
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="sm:flex justify-end hidden pr-16 lg:pr-0">
                        @guest
                            <a
                                href="javascript:void(0)"
                                class=" text-base font-medium text-dark hover:text-primary py-3 px-7 ">
                                {{__('Login') }}
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="text-base font-medium text-white bg-primary rounded-lg py-3 px-7 hover:bg-opacity-90">
                                {{__('Sign Up') }}
                            </a>
                        @endguest
                        @auth
                            <li>
                                <a href="{{route('user.dashboard')}}"
                                   class="text-base font-medium text-white bg-primary rounded-lg py-3 px-7 hover:bg-opacity-90">
                                    {{__('Dashboard') }}
                                </a>
                            </li>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ====== Navbar Section End -->
</div>
<div>
    {{$slot}}
</div>
</body>
</html>
