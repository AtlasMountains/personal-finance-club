<x-layout.app xmlns="http://www.w3.org/1999/html">
    <div class="flex flex-col items-center justify-center h-full">
        <x-forms.form class="dark:my-0">

            <h1 class="text-3xl font-bold text-center dark:text-white">
                {{ __('login') }}
            </h1>

            @if ($errors->any())
                <div class="bg-red-500 alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <x-forms.input for="email" type="email" value="{{ old('email') }}">
                {{ __('email') }}
            </x-forms.input>

            <x-forms.input for="password" type="password">
                {{ __('password') }}
            </x-forms.input>

            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember"
                    class="text-sm text-body-color dark:text-gray-200">{{ __('Remember me') }}</label>
            </div>

            <x-forms.button type="submit">
                {{ __('submit') }}
            </x-forms.button>

            @if ($remaining > 0)
                <div class="dark:text-white">
                    {{ trans_choice('auth.login_available', $remaining, compact('remaining')) }}
                </div>
            @else
                <div class="px-3 bg-yellow-400 rounded">
                    {{ __('auth.throttle_wait', compact('wait_time')) }}
                </div>
            @endif

            <div>
                <a href="{{ route('register') }}"
                    class="text-sm text-body-color dark:text-gray-200">
                    {{ __('no account yet? sign up') }}
                </a>
            </div>

        </x-forms.form>
    </div>
</x-layout.app>
