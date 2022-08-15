<x-layout.power>

  <x-notifications/>
  <x-dialog/>

  <h1 class="px-3 text-2xl font-semibold text-center dark:text-white">
    Account: {{ $account->name }}
  </h1>

  <div class="ml-5 text-lg dark:text-white">
    balance:
    {{ $balance }}
    <br>
    income Last Month:
    {{ $incomeLastMonth }}
    <br>
    expense Last Month:
    {{ $expenseLastMonth }}
    <br>
    income This Year:
    {{ $incomeThisYear }}
    <br>
    expense this year
    {{ $expenseThisYear }}
    <br>
  </div>

  @if($account->user->id === auth()->user()->id)
    <div class="w-full">
      <livewire:transactions :account="$account"/>
    </div>
  @endif

  <div class="w-full px-10 pb-10 mx-auto dark:bg-slate-900">
    <livewire:transactions-table :account="$account" :transactions="$transactions"/>
  </div>

</x-layout.power>
