<section>

  <div class="flex flex-col w-full text-center">
    <h1 class="text-lg font-semibold text-center dark:text-white">Family</h1>
    <p class="text-center text-gray-600 dark:text-gray-400">manage your family</p>
  </div>

  @if(!isset(auth()->user()->family))
    <ul class="text-lg m-16 xl:m-32 py-5 font-bold text-white bg-slate-700 rounded-lg shadow-lg text-center">
      <li>
        <a href="{{route("user.family.create")}}">create a family</a>
      </li>
      <li>---join a family---</li>
    </ul>
  @else

    <ul class="text-lg m-16 py-5 font-bold text-white bg-slate-700 rounded-lg shadow-lg text-center">
      <li>---leave a family---</li>
      <li>---view family accounts---</li>

      @if((int)$family->head === auth()->user()->id)
        <li>---add member---</li>
        <li>---remove member---</li>
      @endif
    </ul>

    @foreach($family->usersWithAccounts as $user)
      @if(count($user->accounts))
        <table class="w-full rounded-lg shadow py-2 my-5">
          <thead
            class="bg-gray-200 border-2 border-slate-500 dark:bg-slate-500 dark:border-gray-400 dark:text-gray-200">
          <tr>
            <th colspan="2"
                class="text-center bg-slate-700 text-white">{{ $user->first_name }} {{ $user->last_name }}</th>
          </tr>
          <tr>
            <th class="p-3 text-sm font-semibold tracking-wide text-left">name</th>
            <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">type</th>
            @if($family->created_by === auth()->user()->id)
              <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left">edit</th>
              <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left">delete</th>
            @endif
          </tr>
          </thead>

          <tbody>
          @foreach ($user->accountsWithTypes as $account)
            <tr class="{{ $loop->index % 2 ? 'bg-gray-200 dark:bg-slate-500' : 'bg-white dark:bg-slate-400' }}">
              <td class="p-3 text-sm font-bold">
                <a href="{{ route('user.account.show', $account) }}"
                   class="px-3 py-0.5 hover:bg-secondary-500 focus:bg-secondary-500 dark:hover:bg-secondary-700 dark:focus:bg-secondary-700 rounded-lg bg-red-500 bg-opacity-60 text-gray-100">
                  {{ $account->name }}
                </a>
              </td>
              <td class="p-3 text-sm dark:text-gray-100">
                {{ $account->accountType->type }}
              </td>
              @if(auth()->user()->family->created_by === auth()->user()->id)
                <td class="p-3 text-sm">
                  <a href="{{ route('user.account.edit', $account) }}">
                    <x-icon name="pencil" solid="true"
                            class="w-6 h-6 hover:text-primary-500 focus:text-primary-500 dark:hover:text-white dark:focus:text-white"/>
                  </a>
                </td>
                <td class="p-3 text-sm">
                  <button wire:click="deleteRequest({{ $account->id }})">
                    <x-icon name="trash" solid="true"
                            class="w-10 h-10 text-red-500 cursor-pointer hover:text-secondary-500 focus:text-secondary-500 dark:hover:text-secondary-700 dark:focus:text-secondary-700"/>
                  </button>
                </td>
              @endif
            </tr>
          @endforeach
          </tbody>
        </table>
      @endif
    @endforeach
  @endif

</section>
