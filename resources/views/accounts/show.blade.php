<x-layout.chart>

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
      </div>
    </div>

    <script>
      const categoryChartLabels = {{ Js::from($expensesPerCategory['category']) }};
      const categoryIncomeData = {{ Js::from($incomePerCategory['amount']) }};
      const categoryExpenseData = {{ Js::from($expensesPerCategory['amount']) }};
      const categoryNettoData = {{ JS::from($nettoPerCategory['amount']) }};

      const yearsChartLabels = {{ Js::from($incomePerYear['years']) }};
      const yearsIncomeData = {{ Js::from($incomePerYear['amount']) }};
      const yearsExpenseData = {{ Js::from($expensePerYear['amount']) }};
      const yearsNettoData = {{ Js::from($nettoPerYear['amount']) }};

      const monthChartLabels = {{ Js::from($incomePerMonth['months']) }};
      const monthIncomeData = {{ Js::from($incomePerMonth['amount']) }};
      const monthExpenseData = {{ Js::from($expensePerMonth['amount']) }};
      const monthNettoData = {{ Js::from($nettoPerMonth['amount']) }};
    </script>

    <div class="px-10 gap-3 grid grid-cols-2">
      <div class="h-96">
        <canvas id="years"></canvas>
      </div>
      <div class="h-96">
        <canvas id="months"></canvas>
      </div>
    </div>

    <div class="px-10 my-2 h-96">
      <canvas id="categories"></canvas>
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
</x-layout.chart>
