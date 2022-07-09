<nav {{ $attributes->merge(['class' => 'p-3 bg-gray-100 flex items-center']) }}>
    <span class="text-lg font-bold text-center">ROLE</span>

    <div class="flex flex-row w-4/5 gap-5 mx-auto justify-evenly">

        <div x-data="{ showFamilies: false }">
            <button @click="showFamilies =! showFamilies">
                {{ trans('Family Accounts') }}
            </button>

            @if (!is_null($family))
                <ul class="overflow-auto max-h-96 absolute z-10 m-4 space-y-2 bg-white rounded shadow-2xl min-w-[100px] tansition text-center"
                    x-show="showFamilies" @click.outside="showFamilies = false">
                    @foreach ($familyUsersWithAccounts as $user)
                        <div class="bg-secondary">{{ $user->first_name }}, {{ $user->last_name }}</div>
                        @foreach ($user->accounts as $account)
                            <li class="px-5 rounded">
                                <a href="{{ route('user.account.show', $account) }}"
                                    class="hover:text-secondary focus:text-secondary">
                                    {{ $account->name }}
                                </a>
                            </li>
                        @endforeach
                        <hr>
                    @endforeach
                </ul>
            @endif
        </div>

        <div x-data="{ showUserAccounts: false }">
            <button @click="showUserAccounts =! showUserAccounts">
                {{ trans('Your accounts') }}
            </button>

            <ul class="absolute m-4 space-y-2 bg-white z-10 rounded shadow min-w-[100px] tansition text-center"
                x-show="showUserAccounts" @click.outside="showUserAccounts = false">
                @foreach ($user->accounts as $account)
                    <li class="px-3 rounded">
                        <a href="{{ route('user.account.show', $account) }}"
                            class="hover:text-secondary focus:text-secondary">
                            {{ $account->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <span>add,</span>
            <span>manage</span>
        </div>

</nav>
