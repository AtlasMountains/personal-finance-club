<?php

namespace App\Services;

use NumberFormatter;

class FormatNumberService
{
    public function getFormatedNumber(
        $value,
        $locale = 'nl_BE',
        $style = NumberFormatter::DECIMAL,
        $precision = 2,
        $groupingUsed = true,
        $currencyCode = 'EUR',
    ): bool|string {
        $formatter = new NumberFormatter($locale, $style);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        $formatter->setAttribute(NumberFormatter::GROUPING_USED, $groupingUsed);
        if ($style === NumberFormatter::CURRENCY) {
            $formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE, $currencyCode);
        }

        return $formatter->format($value);
    }
}
