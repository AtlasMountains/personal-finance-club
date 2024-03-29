<section>

  <div class="flex flex-col w-full text-center">
    <h1 class="text-lg font-semibold text-center dark:text-white">Family {{ $family?->name }}</h1>

    @if(count($invites))
      <ul
        class="text-lg mx-5 py-5 space-y-1 font-bold text-white bg-slate-700 rounded-lg shadow-lg text-center">
        <p>you have been invited to join {{ Illuminate\Support\Str::plural('family', $invites) }}</p>
        @foreach($invites as $invite)
          @if($familyInvite = \App\Models\Family::find((int)$invite->data['familyId']))
            <li>
              {{ $familyInvite->name }}
              <x-button icon="check" positive label="Join" wire:click="joinFamily({{ $invite }})"/>
              <x-button icon="trash" negative wire:click="deleteNotification({{ $invite }})"/>
            </li>
          @endif
        @endforeach
      </ul>
    @endif

    @if($family)
      @if(auth()->user()->id === (int)$family->head)
        <a
          href="{{ route('user.family.edit', $family) }}"
          class="text-center text-gray-600 dark:text-gray-400 hover:text-primary-500
        focus:text-primary-500 dark:hover:text-white dark:focus:text-white">
          manage your family
          <x-icon name="pencil" solid="true"
                  class="inline w-6 h-6"/>
        </a>

        <div x-data="{ open: false }">
          <button
            x-on:click="open = ! open"
            class="text-center text-gray-600 dark:text-gray-400 hover:text-primary-500
        focus:text-primary-500 dark:hover:text-white dark:focus:text-white">
            invite a member
            <x-icon name="user-add" solid="true"
                    class="inline w-6 h-6"/>
          </button>

          <form wire:submit.prevent="inviteMember" x-show="open" class="mx-auto space-y-1">
            <x-input icon="mail" label="Email" placeholder="email" type="email" wire:model.lazy="email"/>
            <x-button positive label="invite" type="submit"/>
          </form>
        </div>

      @else
        <form action="{{ route('user.leaveFamily') }}" method="post">
          @csrf
          <button type="submit"
                  class="text-center text-gray-600 dark:text-gray-400 hover:text-primary-500
                focus:text-primary-500 dark:hover:text-white dark:focus:text-white">
            Leave Family
            <x-icon name="user-remove"
                    class="inline w-6 h-6"/>
          </button>
        </form>
      @endif
    @endif
  </div>

  @if(!$family)
    <ul
      class="text-lg my-16 xl:my-32 mx-5 py-5 space-y-1 font-bold text-white bg-slate-700 rounded-lg shadow-lg text-center">
      <li>
        <a href="{{ route("user.family.create") }}" class="focus:text-primary-300 hover:text-primary-300">
          create a family
          <x-icon name="user-group" class=" inline w-6 h-6"/>
        </a>
      </li>
      <li class="text-base">ask the head of a family to invite you</li>
    </ul>
  @else

    @foreach($family->usersWithAccountsAndTypes as $user)
      @if(count($user->accountsWithTypes))
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
          @foreach ($user->accountsWithTypes->sortby('position')->where('family_id',$family->id) as $account)
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
              @if($family->created_by === auth()->user()->id)
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
