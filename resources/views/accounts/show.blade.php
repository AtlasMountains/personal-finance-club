<x-layout.power>

  <x-notifications/>
  <x-dialog/>

  <h1 class="px-3 text-2xl font-semibold text-center dark:text-white">
    Account: {{ $account->name }}
  </h1>

  <div class="w-full">
    <livewire:transactions :account="$account"/>
  </div>

  <div class="w-full px-10 pb-10 mx-auto dark:bg-slate-900">
    <livewire:transactions-table :account="$account" :transactions="$transactions">
  </div>

</x-layout.power>
