<x-layout.app xmlns="http://www.w3.org/1999/html">

  <x-forms.form class="dark:my-0">

    <h1 class="text-center font-bold text-3xl dark:text-white">
      {{ __('login') }}
    </h1>

    @if(session('status'))
      <div class="alert bg-red-500">
        {{ session('status') }}
      </div>
    @endif

    <x-forms.input for="email" type="email" value="{{ session('email') }}">
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

    <div>
      <a href="{{ route('register') }}"
         class="text-sm text-body-color
        dark:text-gray-200">
        {{__('no account yet? sign up')}}
      </a>
    </div>
  </x-forms.form>
</x-layout.app>
