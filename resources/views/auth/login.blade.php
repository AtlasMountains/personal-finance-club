<x-layout.app>

  <div class="flex flex-col items-center justify-center h-full mx-auto md:w-3/5">
    <x-forms.form class="dark:my-0">

      <h1 class="text-3xl font-bold text-center dark:text-white">
        {{ __('login') }}
      </h1>

      @if(Session::has('status'))
        <p class="alert bg-slate-700 dark:bg-white dark:text-black">
          {{Session::get('status')}}
        </p>
      @endif

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

      <div class="text-center space-y-3">
        <p>
          <a href="{{ route('password.request') }}"
             class="hover:underline hover:text-blue-500 text-sm text-body-color dark:text-gray-200 dark:hover:text-blue-500">
            {{ __('reset your password?') }}
          </a>
        </p>
        <p>
          <a href="{{ route('register') }}"
             class="hover:underline hover:text-blue-500 text-sm text-body-color dark:text-gray-200 dark:hover:text-blue-500">
            {{ __('no account yet? sign up') }}
          </a>
        </p>
      </div>

    </x-forms.form>
  </div>
</x-layout.app>
