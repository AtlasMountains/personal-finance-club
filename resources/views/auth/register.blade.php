<x-layout.app xmlns="http://www.w3.org/1999/html">

  <x-forms.form class="dark:my-0">

    <h1 class="text-center font-bold text-3xl dark:text-white">
      {{ __('register') }}
    </h1>

    <x-forms.input for="first_name">
      {{ __('First name') }}
    </x-forms.input>

    <x-forms.input for="last_name">
      {{ __('Last name') }}
    </x-forms.input>

    <x-forms.input for="email" type="email">
      {{ __('email') }}
    </x-forms.input>

    <x-forms.input for="password" type="password">
      {{ __('password') }}
    </x-forms.input>

    <x-forms.input for="password_again" type="password">
      {{ __('password again') }}
    </x-forms.input>

    <x-forms.button type="submit">
      {{ __('submit') }}
    </x-forms.button>

  </x-forms.form>
</x-layout.app>
