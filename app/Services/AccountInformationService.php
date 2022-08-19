<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Category;
use Carbon\Carbon;
use NumberFormatter;

class AccountInformationService extends FormatNumberService
{
    public float $balance;

    public float $incomeLastMonth;

    public float $expenseLastMonth;

    public float $incomeThisYear;

    public float $expenseThisYear;

    private array $incomePerCategory;

    public array $expensesPerCategory;

    private array $nettoPerCategory;

    public function __construct(public Account $account)
    {
    }

    private function calculateBalance(): void
    {
        $balance = $this->account->start_balance + $this->account->transactions->sum('amount');
        $this->balance = $balance;
    }

    private function sumTransactionsBetween($startDate, $endDate, $operator)
    {
        return $this->account->transactions()
            ->whereBetween('date', [$startDate, $endDate])
            ->where('amount', $operator, 0)
            ->sum('amount');
    }

    private function calculatePerYear(string $operator = '>', bool $netto = false): array
    {
        $earliestTransactionDate = Carbon::create(
            $this->account->transactions()->orderBy('date')->first()->date
        );
        $yearsWorthOfData = now()->year - $earliestTransactionDate->year;
        $maxYearsToShowInGraph = 10;

        if ($yearsWorthOfData <= $maxYearsToShowInGraph) {
            $startYear = $earliestTransactionDate->year;
        } else {
            $startYear = now()->year - $maxYearsToShowInGraph;
        }
        $result = [];
        for ($i = $startYear; $i <= now()->year; $i++) {
            $result['years'][] = Carbon::create($i)->year;
            $firstDayOfYear = Carbon::create($i);
            $lastDayOfYear = Carbon::create($i)->endOfYear();
            if ($netto) {
                $result['amount'][] = $this->account->transactions()
                    ->whereBetween('date', [$firstDayOfYear, $lastDayOfYear])
                    ->sum('amount');
            } else {
                $result['amount'][] = $this->account->transactions()
                    ->where('amount', $operator, 0)
                    ->whereBetween('date', [$firstDayOfYear, $lastDayOfYear])
                    ->sum('amount');
            }
        }
        return $result;
    }

    private function calculatePerMonth($year = null, string $operator = '>', bool $netto = false): array
    {
        $year ?: now()->year;

        $result = [];
        for ($i = 0; $i <= 11; $i++) {
            $result['months'][] = Carbon::create($year)->addMonths($i)->monthName;
            $startOfMonth = Carbon::create($year)->addMonths($i)->startOfMonth();
            $endOfMonth = Carbon::create($year)->addMonths($i)->endOfMonth();
            
            if ($netto) {
                $result['amount'][] = $this->account->transactions()
                    ->whereBetween('date', [$startOfMonth, $endOfMonth])
                    ->sum('amount');
            } else {
                $result['amount'][] = $this->account->transactions()
                    ->where('amount', $operator, 0)
                    ->whereBetween('date', [$startOfMonth, $endOfMonth])
                    ->sum('amount');
            }
        }
        return $result;
    }

    private function calculateIncomeLastMonth(): void
    {
        $startDate = now()->previous('month')->startOfMonth();
        $endDate = now()->previous('month')->endOfMonth();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '>');
        $this->incomeLastMonth = $result;
    }

    private function calculateExpenseLastMonth(): void
    {
        $startDate = now()->previous('month')->startOfMonth();
        $endDate = now()->previous('month')->endOfMonth();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '<');
        $this->expenseLastMonth = $result;
    }

    private function calculateIncomeThisYear(): void
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '>');
        $this->incomeThisYear = $result;
    }

    private function calculateExpenseThisYear(): void
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '<');
        $this->expenseThisYear = $result;
    }

    private function calculatePerCategory($begin = false, $end = false, string $operator = '>', $netto = false): void
    {
        $startDate = $begin ?: now()->startOfYear();
        $endDate = $end ?: now();

        $result = [];
        foreach (Category::all() as $category) {
            if ($netto) {
                $result[$category->category] =
                    $this->account->transactions()
                        ->where('category_id', $category->id)
                        ->whereBetween('date', [$startDate, $endDate])
                        ->sum('amount');
            } else {
                $result[$category->category] =
                    $this->account->transactions()
                        ->where('category_id', $category->id)
                        ->whereBetween('date', [$startDate, $endDate])
                        ->where('amount', $operator, 0)
                        ->sum('amount');
            }
        }
        if ($netto) {
            $this->nettoPerCategory = $result;
        } else {
            if ($operator === '>') {
                $this->incomePerCategory = $result;
            } else {
                $this->expensesPerCategory = $result;
            }
        }
    }

    public function getBalance(): bool|string
    {
        $this->calculateBalance();

        return $this->getFormatedNumber($this->balance, style: NumberFormatter::CURRENCY);
    }

    public function getIncomeLastMonth(): bool|string
    {
        $this->calculateIncomeLastMonth();

        return $this->getFormatedNumber($this->incomeLastMonth, style: NumberFormatter::CURRENCY);
    }

    public function getExpenseLastMonth(): bool|string
    {
        $this->calculateExpenseLastMonth();

        return $this->getFormatedNumber($this->expenseLastMonth, style: NumberFormatter::CURRENCY);
    }

    public function getIncomeThisYear(): bool|string
    {
        $this->calculateIncomeThisYear();

        return $this->getFormatedNumber($this->incomeThisYear, style: NumberFormatter::CURRENCY);
    }

    public function getExpenseThisYear(): bool|string
    {
        $this->calculateExpenseThisYear();

        return $this->getFormatedNumber($this->expenseThisYear, style: NumberFormatter::CURRENCY);
    }

    public function getIncomePerCategory(): array
    {
        $this->calculatePerCategory(operator: '>');
        foreach ($this->incomePerCategory as $category => $amount) {
            $result['category'][] = $category;
            $result['amount'][] = $amount;
        }

        return $result;
    }

    public function getExpensesPerCategory(): array
    {
        $this->calculatePerCategory(operator: '<');
        foreach ($this->expensesPerCategory as $category => $amount) {
            $result['category'][] = $category;
            $result['amount'][] = $amount;
        }

        return $result;
    }

    public function getNettoPerCategory(): array
    {
        $this->calculatePerCategory(netto: true);
        foreach ($this->nettoPerCategory as $category => $amount) {
            $result['category'][] = $category;
            $result['amount'][] = $amount;
        }
        return $result;
    }

    public function getIncomePerYear(): array
    {
        return $this->calculatePerYear(operator: '>');
    }

    public function getExpensePerYear(): array
    {
        return $this->calculatePerYear(operator: '<');
    }

    public function getNettoPerYear(): array
    {
        return $this->calculatePerYear(netto: true);
    }

    public function getIncomePerMonth(): array
    {
        return $this->calculatePerMonth(operator: '>');
    }

    public function getExpensePerMonth(): array
    {
        return $this->calculatePerMonth(operator: '<');
    }

    public function getNettoPerMonth(): array
    {
        return $this->calculatePerMonth(netto: true);
    }
}
