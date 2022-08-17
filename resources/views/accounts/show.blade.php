<x-layout.power>

  <x-notifications/>
  <x-dialog/>
  <div class="dark:bg-slate-900">

    <h1 class="px-3 text-2xl font-semibold text-center dark:text-white">
      Account: {{ $account->name }}
    </h1>

    <div class="ml-5 text-lg dark:text-white grid grid-cols-2">

      <div>
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

      <div>
        <h2 class="text-xl font-semibold py-1">expenses per category</h2>
        @foreach($expensePerCategory as $category => $expense)
          @if($expense === 0)
            @continue
          @endif
          {{ $category }} : {{ $expense }} <br>
        @endforeach
      </div>
    </div>

    @if($account->user->id === auth()->user()->id)
      <div class="w-full">
        <livewire:transactions :account="$account"/>
      </div>
    @endif

    <div class="w-full px-10 pb-10 mx-auto">
      <livewire:transactions-table :account="$account" :transactions="$transactions"/>
    </div>

  </div>
</x-layout.power>
