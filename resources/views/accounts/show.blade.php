<x-layout.power>

    <h1 class="text-2xl font-semibold px-3 text-center dark:text-white">
        {{ $account->name }}
    </h1>

    <div class="w-full">
        <livewire:transactions />
    </div>

    <div class="w-full px-10 mx-auto">
        <livewire:transactions-table :account='$account'>
    </div>

</x-layout.power>
