<x-layout.power>
    <h1 class="text-2xl font-semibold px-3 text-center">
        {{ $account->name }}
    </h1>
    <div class="w-full px-10 mx-auto">
        <livewire:transactions :account='$account'>
    </div>

</x-layout.power>
