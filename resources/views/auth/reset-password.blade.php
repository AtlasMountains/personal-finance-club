<x-layout.app xmlns="http://www.w3.org/1999/html">
  <div class="flex flex-col items-center justify-center h-full mx-auto lg:w-3/5">
    <x-forms.form action="{{ route('password.update') }}" class="dark:my-0">

      <h1 class="text-3xl font-bold text-center dark:text-white">
        {{ __('Reset Password') }}
      </h1>

      @if ($errors->any())
        <div class="bg-red-500 alert">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
      @endif

      <input type="hidden" name="token" id="token" value="{{ $token }}">

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

    </x-forms.form>
  </div>
</x-layout.app>
