<section class="mx-auto space-y-5 md:px-3 lg:px-0 ">
    <div class="flex flex-col w-full text-center">
        <h1 class="text-lg font-semibold text-center dark:text-white">Accounts</h1>
        <p class="text-center text-gray-600 dark:text-gray-400">manage your accounts</p>
    </div>

    @if (count($accounts) === 0)
        <p class="px-3 py-0.5 tracking-wide text-center">You don't have any personal accounts yet please create one</p>
    @else
        <table class="w-full rounded-lg shadow py-2">
            <thead class="bg-gray-200 border-2 border-slate-500">
                <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">name</th>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">type</th>
                    <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left">edit</th>
                    <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left">delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($accounts as $account)
                    <tr class="{{ $loop->index % 2 ? 'bg-gray-200' : 'bg-white' }}">
                        <td class="p-3 text-sm font-bold">
                            <a href="{{ route('user.account.show', $account) }}"
                                class="px-3 py-0.5 hover:bg-secondary-500 focus:bg-secondary-500 rounded-lg bg-red-500 text-white">
                                {{ $account->name }}
                            </a>
                        </td>
                        <td class="p-3 text-sm">
                            {{ $account->accountType->type }}
                        </td>

                        <td class="p-3 text-sm">
                            <a href="{{ route('user.account.edit', $account) }}">
                                <x-icon name="pencil" solid="true"
                                    class="w-6 h-6 hover:text-primary-500 focus:text-primary-500" />
                            </a>
                        </td>
                        <td class="p-3 text-sm">
                            <button wire:click.debounce.150ms="deleteRequest({{ $account }})">
                                <x-icon name="trash" solid="true"
                                    class="w-10 h-10 text-red-500 cursor-pointer hover:text-secondary-500" />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="flex w-full">
        <a href="{{ route('user.account.create') }}"
            class="p-3 ml-auto text-lg text-center text-white bg-red-500 hover:bg-secondary-500 rounded-lg shadow">
            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                mlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                </path>
            </svg>
            Create Account
        </a>
    </div>
</section>
