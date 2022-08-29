<x-layout.app xmlns="http://www.w3.org/1999/html">
    <div class="flex flex-col items-center justify-center h-full mx-auto lg:w-3/5">
        <x-forms.form class="dark:my-0">

            <h1 class="text-3xl font-bold text-center dark:text-white">
                {{ __('register') }}
            </h1>

            @error('max_attempts')
                <div class="bg-red-500 alert">
                    {{ $errors->first('max_attempts') }}
                </div>
            @enderror

            <div class="flex flex-col items-center w-full space-x-2 space-y-6 md:flex-row md:space-y-0 md:w-4/5 md:">
                <x-forms.input for="first_name" value="{{ old('first_name') }}">
                    {{ __('First name') }}
                </x-forms.input>

                <x-forms.input for="last_name" value="{{ old('last_name') }}">
                    {{ __('Last name') }}
                </x-forms.input>
            </div>

            <x-forms.input for="email" type="email" value="{{ old('email') }}">
                {{ __('email') }}
            </x-forms.input>

            <x-forms.input for="password" type="password">
                {{ __('password') }}
            </x-forms.input>

            <x-forms.input for="password_confirmation" type="password">
                {{ __('confirm password') }}
            </x-forms.input>

            <x-forms.button type="submit">
                {{ __('submit') }}
            </x-forms.button>

            @if ($remaining > 0)
                <div class="px-3 rounded dark:text-white">
                    {{ trans_choice('auth.register_available', $remaining, compact('remaining')) }}
                </div>
            @else
                <div class="px-3 bg-yellow-400 rounded">
                    <p>{{ __('auth.throttle_wait', compact('wait_time')) }}</p>
                </div>
            @endif
        </x-forms.form>
    </div>
</x-layout.app>
