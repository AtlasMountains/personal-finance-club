<x-layout.app>

  <h1 class="text-3xl font-bold text-center dark:text-white">create a Family</h1>

  <x-forms.form action="{{ route('user.family.store') }}" class="md:w-3/5 mx-auto">

    <x-forms.input for="name" :value="old('name')">
      Family name
    </x-forms.input>

    <p>Select all account you want to be part of the family</p>
    @foreach($accounts as $account)
      <p class="text-center p-3">
        <label> {{$account->name}}
          <input type="checkbox" value="{{$account->id}}" name="accounts[]" checked></input>
        </label>
      </p>
    @endforeach

    <x-forms.button type="submit">submit</x-forms.button>

  </x-forms.form>
</x-layout.app>
