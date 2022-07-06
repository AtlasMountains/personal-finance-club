<x-layout.app>

    <x-slot name='styles'>
        @livewireStyles
        @powerGridStyles
    </x-slot>
    <x-slot name='scripts'>
        @livewireScripts
        @powerGridScripts
    </x-slot>

    <div class="flex flex-col h-fit md:flex-row">
        <aside class="px-3 bg-cyan-600">

            <div class="text-lg font-bold text-center">ROLE</div>
            <ul class="pl-3 space-y-2">
                <li class="">family
                    @if ($family)
                        {{ $family->name }}
                        <ul>
                            @foreach ($familyAccounts as $account)
                                <li class="ml-3">
                                    <a href="{{ route('user.account.show', $account) }}">{{ $account->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>

                <li class="">accounts
                    <ul class="flex flex-col">
                        @foreach ($userAccounts as $account)
                            <li class="ml-3">
                                <a href="{{ route('user.account.show', $account) }}">{{ $account->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </aside>

        <section class="flex-1">
            {{ $slot }}
        </section>

    </div>
</x-layout.app>
