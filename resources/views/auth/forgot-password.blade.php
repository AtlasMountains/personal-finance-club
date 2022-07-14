<x-layout.app>

  <div class="flex flex-col items-center justify-center h-full mx-auto md:w-3/5">
    <x-forms.form class="dark:my-0">

      <h1 class="text-3xl font-bold text-center dark:text-white">
        {{ __('Reset password') }}
      </h1>
      <p class="dark:text-gray-100">{{ __('auth.reset_password_body') }}</p>

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

      <x-forms.input for="email" type="email">
        {{ __('email') }}
      </x-forms.input>

      <x-forms.button type="submit">
        {{ __('submit') }}
      </x-forms.button>

    </x-forms.form>
  </div>
</x-layout.app>
