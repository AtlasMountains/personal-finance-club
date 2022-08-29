<x-layout.app>

  <h1 class="text-3xl font-bold text-center dark:text-white">Edit Family {{ $family->name }}</h1>

  <x-forms.form
    action="{{ route('user.family.update', $family) }}"
    class=""
  >
    @method('PATCH')
    <div class="flex flex-col h-full">

      <div class="grid gap-4 px-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">

          <x-forms.input for="name" :value="$family->name">
            Family name
          </x-forms.input>

        </div>

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">

          <label for="head" class="text-sm dark:text-gray-400">change the head of the family</label>
          <select name="head" id="head" class="text-center block mx-auto pr-7 pl-2 py-2 my-5 bg-white rounded shadow">
            @foreach($family->users as $user)
              <option value="{{ $user->id }}"
                      @if((int)$user->id === (int)$family->head) selected @endif >
                {{ $user->first_name }} {{ $user->last_name }}
              </option>
            @endforeach
          </select>

        </div>

        <div class="p-2 space-y-3 bg-gray-100 rounded shadow dark:bg-slate-600">

          <h2 class="text-xl text-body-color dark:text-white">manage family members</h2>

          <p class="text-xs m-0 p-0 text-gray-500 dark:text-gray-400">
            select members of the family you wish to kick out
          </p>
          <ul class="text-center px-3 text-body-color dark:text-gray-200">
            @foreach($family->users as $user)
              <li>
                <label class="text-body-color dark:text-gray-200"> {{$user->first_name}} {{$user->last_name}}
                  <input type="checkbox" value="{{$user->id}}" name="users[]" id="{{$user->id}}"></input>
                </label>
              </li>
            @endforeach
          </ul>

        </div>

      </div>
    </div>

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
