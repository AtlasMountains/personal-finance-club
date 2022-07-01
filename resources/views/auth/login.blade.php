<x-layout.app xmlns="http://www.w3.org/1999/html">
  <div class="h-full flex flex-col items-center justify-center">

    <x-forms.form class="dark:my-0">

      <h1 class="text-center font-bold text-3xl dark:text-white">
        {{ __('login') }}
      </h1>

      @if(session('status'))
        <div class="alert bg-red-500">
          {{ session('status') }}
        </div>
      @endif

      @if(session('max_attempts'))
        <div class="alert bg-red-500">
          {{ session('max_attempts') }}
        </div>
      @endif

      <x-forms.input for="email" type="email" value="{{  old('email') ?: session('email')}}">
        {{ __('email') }}
      </x-forms.input>

      <x-forms.input for="password" type="password">
        {{ __('password') }}
      </x-forms.input>

      <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember" class="text-sm text-body-color
        dark:text-gray-200">{{__('Remember me')}}</label>
      </div>

      <x-forms.button type="submit">
        {{ __('submit') }}
      </x-forms.button>
      @if( $remaining > 0 )
        <div class="">
          {{ __('auth.login_available') }} {{ $remaining }}
        </div>
      @else
        <div class="">
          <p>{{ __('auth.throttle_wait') }} {{ $wait_time }} {{ __('seconds') }}</p>
        </div>
      @endif
      <div>
        <a href="{{ route('register') }}"
           class="text-sm text-body-color
        dark:text-gray-200">
          {{__('no account yet? sign up')}}
        </a>
      </div>
    </x-forms.form>
  </div>
</x-layout.app>
