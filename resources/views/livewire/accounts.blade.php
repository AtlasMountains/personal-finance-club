<section class="mx-auto space-y-1 md:px-3 lg:px-0 ">

    <div class="flex flex-col w-full text-center">
        <h1 class="text-lg font-semibold text-center dark:text-white">Accounts</h1>
        <p class="text-center text-gray-600 dark:text-gray-400">manage your accounts</p>
    </div>

    @if (count($user->accounts) === 0)
        <p>you don't have any personal accounts yet please create one</p>
    @else
        <div class="w-full mx-auto overflow-auto">
            <table class="whitespace-no-wrap table-auto">
                <tbody>
                    @foreach ($user->accounts as $account)
                        <tr>
                            <td><a href="{{ route('user.account.show', $account) }}"
                                    class="px-3 bg-red-500 rounded hover:text-secondary focus:text-secondary">
                                    {{ $account->name }}
                                </a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="flex w-full ">
        <a class="inline-flex items-center text-red-500">
            <x-icon name="trash" class="w-10 h-10" />
        </a>

        <a href="{{ route('user.account.create') }}"
            class="p-3 ml-auto text-lg text-center text-white bg-red-500 rounded shadow">
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
