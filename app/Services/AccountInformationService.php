<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Category;
use NumberFormatter;

class AccountInformationService
{
    public float $balance;

    public float $incomeLastMonth;

    public float $expenseLastMonth;

    public float $incomeThisYear;

    public float $expenseThisYear;

    public array $expensePerCategory;

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

    private function calculateIncomeLastMonth(): void
    {
        $startDate = now()->startOfMonth()->previous('month');
        $endDate = now()->startOfMonth();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '>');
        $this->incomeLastMonth = $result;
    }

    private function calculateExpenseLastMonth(): void
    {
        $startDate = now()->startOfMonth()->previous('month');
        $endDate = now()->startOfMonth();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '<');
        $this->expenseLastMonth = $result;
    }

    private function calculateIncomeThisYear(): void
    {
        $startDate = now()->startOfYear();
        $endDate = now();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '>');
        $this->incomeThisYear = $result;
    }

    private function calculateExpenseThisYear(): void
    {
        $startDate = now()->startOfYear();
        $endDate = now();

        $result = $this->sumTransactionsBetween($startDate, $endDate, '<');
        $this->expenseThisYear = $result;
    }

    private function calculateExpensesPerCategory($begin = false, $end = false): void
    {
        $startDate = $begin ?: now()->startOfYear();
        $endDate = $end ?: now();

        $result = [];
        foreach (Category::all() as $category) {
            $result[$category->category] =
                $this->account->transactions()
                    ->where('category_id', $category->id)
                    ->whereBetween('date', [$startDate, $endDate])
                    ->sum('amount');
        }
        $this->expensePerCategory = $result;
    }

    private function getFormatedNumber(
        $value,
        $locale = 'nl_BE',
        $style = NumberFormatter::DECIMAL,
        $precision = 2,
        $groupingUsed = true,
        $currencyCode = 'EUR',
    ): bool|string
    {
        $formatter = new NumberFormatter($locale, $style);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        $formatter->setAttribute(NumberFormatter::GROUPING_USED, $groupingUsed);
        if ($style === NumberFormatter::CURRENCY) {
            $formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE, $currencyCode);
        }

        return $formatter->format($value);
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

    public function getExpensesPerCategoryFormatted(): array
    {
        $this->calculateExpensesPerCategory();
        $result = [];
        foreach ($this->expensePerCategory as $category => $expense) {
            $result[$category] = $this->getFormatedNumber($expense, style: NumberFormatter::CURRENCY);
        }

        return $result;
    }

    public function getExpensesPerCategory(): array
    {
        $this->calculateExpensesPerCategory();

        return $this->expensePerCategory;
    }
}
