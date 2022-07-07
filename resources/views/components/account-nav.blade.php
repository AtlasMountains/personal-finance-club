<nav {{ $attributes->merge(['class' => 'p-3 bg-teal-500']) }}>
    <span class="text-lg font-bold text-center">ROLE</span>

    <div class="flex flex-row">
        <ul class="p-3">
            <li class="hover:bg-primary" x-data="{ showFamilies: false }" @click="showFamilies =! showFamilies">

                <span class="(isset($family->name) ? cursor-pointer ">
                    family, @if (isset($family))
                        {{ $family->name }}
                    @endif
                </span>

                @if (isset($family))

                    <ul x-show="showFamilies">
                        @foreach ($family->accounts as $account)
                            <li class="ml-3">
                                <a href="{{ route('user.account.show', $account) }}">
                                    {{ $account->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        </ul>

        <ul class="p-3">
            <li class="">accounts
                {{-- <ul class="flex flex-col">
                    @foreach ($user->accounts as $account)
                        <li class="ml-3">
                            <a href="{{ route('user.account.show', $account) }}">
                                {{ $account->name }}
                            </a>
                        </li>
                    @endforeach
                </ul> --}}
            </li>
        </ul>
    </div>

</nav>
