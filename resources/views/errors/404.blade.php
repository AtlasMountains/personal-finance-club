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

<body class="antialiased">

<!-- ====== Error 404 Section Start -->
<section class="bg-primary py-[120px] relative z-10">
    <div class="container">
        <div class="flex -mx-4">
            <div class="w-full px-4">
                <div class="mx-auto max-w-[400px] text-center">
                    <h2
                        class=" font-bold text-white mb-2 text-[50px] sm:text-[80px] md:text-[100px] leading-none ">
                        404
                    </h2>
                    <!--suppress SpellCheckingInspection -->
                    <h4 class="text-white font-semibold text-[22px] leading-tight mb-3">
                        {{ __('Oops! That page can’t be found') }}
                    </h4>
                    <p class="text-lg text-white mb-8">
                        {{ __('The page you are looking for it maybe deleted') }}
                    </p>
                    <a href="{{route('home')}}"
                       class="text-base font-semibold text-white inline-block text-center border border-white rounded-lg px-8 py-3 hover:bg-white hover:text-primary transition ">
                    {{ __('Go To Home') }}
                </div>
            </div>
        </div>
    </div>
    <div
        class=" absolute -z-10 w-full h-full top-0 left-0 flex justify-between items-center space-x-5 md:space-x-8 lg:space-x-14 ">
        <div class="w-1/3 h-full bg-gradient-to-t from-[#FFFFFF14] to-[#C4C4C400]"></div>
        <div class="w-1/3 h-full flex">
            <div class=" w-1/2 h-full bg-gradient-to-b from-[#FFFFFF14] to-[#C4C4C400] "></div>
            <div class=" w-1/2 h-full bg-gradient-to-t from-[#FFFFFF14] to-[#C4C4C400] "></div>
        </div>
        <div class="w-1/3 h-full bg-gradient-to-b from-[#FFFFFF14] to-[#C4C4C400]"></div>
    </div>
</section>
<!-- ====== Error 404 Section End -->

</body>

</html>
