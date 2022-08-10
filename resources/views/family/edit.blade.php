<x-layout.app>

  <h1 class="text-3xl font-bold text-center dark:text-white">Edit Family {{ $family->name }}</h1>

  <x-forms.form
    action="{{ route('user.family.update', $family) }}"
    class="md:w-3/5 mx-auto"
  >
    @method('PATCH')

    <x-forms.input for="name" :value="$family->name">
      Family name
    </x-forms.input>

    <h2 class="text-xl text-body-color dark:text-white">manage family members</h2>
    <p class="text-xs m-0 p-0 text-gray-500 dark:text-gray-400">select members of the family you wish to kick out</p>
    <ul class="text-center px-3 text-body-color dark:text-gray-200">
      @foreach($family->users as $user)
        <li>
          <label class="text-body-color dark:text-gray-200"> {{$user->first_name}} {{$user->last_name}}
            <input type="checkbox" value="{{$user->id}}" name="users[]" id="{{$user->id}}"></input>
          </label>
        </li>
      @endforeach
    </ul>

    @if ($errors->any())
      <div class="alert bg-red-500">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <x-forms.button type="submit">submit</x-forms.button>

  </x-forms.form>
</x-layout.app>
