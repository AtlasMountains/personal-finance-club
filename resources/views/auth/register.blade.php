<x-layout.app xmlns="http://www.w3.org/1999/html">
  <div class="h-full flex flex-col items-center justify-center">
    <x-forms.form class="dark:my-0">

      <h1 class="text-center font-bold text-3xl dark:text-white">
        {{ __('register') }}
      </h1>

      @if(session('max_attempts'))
        <div class="alert bg-red-500">
          {{ session('max_attempts') }}
        </div>
      @endif

      <div class="flex flex-col items-center space-y-6 w-full md:flex-row md:space-y-0 md:w-4/5 md: space-x-2">
        <x-forms.input for="first_name" value="{{old('first_name')}}">
          {{ __('First name') }}
        </x-forms.input>

        <x-forms.input for="last_name" value="{{old('last_name')}}">
          {{ __('Last name') }}
        </x-forms.input>
      </div>

      <x-forms.input for="email" type="email" value="{{old('email')}}">
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

      @if( $remaining > 0 )
        <div class="">
          {{ __('auth.register_available') }} {{ $remaining }}
        </div>
      @else
        <div class="">
          <p>{{ __('auth.throttle_wait') }} {{ $wait_time }}</p>
        </div>
      @endif
    </x-forms.form>
  </div>
</x-layout.app>
