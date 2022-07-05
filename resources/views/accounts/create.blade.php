<x-layout.dash
  :family="$family"
  :familyAccounts="$familyAccounts"
  :userAccounts="$userAccounts"
>

  <h1 class="text-3xl font-bold">create a new account</h1>
  <x-forms.form>

    <x-forms.input
      for="account_name"
      :value="old('account_name')"
    >
      account name
    </x-forms.input>

    <x-forms.input
    for=""
    value=""
    >
      Name
    </x-forms.input>
  </x-forms.form>

</x-layout.dash>
