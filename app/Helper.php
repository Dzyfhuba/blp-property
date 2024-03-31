<?php

namespace App;

class Helper {
    public static function formatAndTrimZeros($value, int $decimalPlaces = 0): string
    {
        //   """
        //   This function formats a number with a specified number of decimal places and removes trailing zeros from the decimal part.

        //   Args:
        //       value: The number to format.
        //       decimalPlaces: The desired number of decimal places (default: 0).

        //   Returns:
        //       A string representing the formatted number with trailing zeros removed.
        //   """

        $formatted = number_format((float) $value, $decimalPlaces);
        return rtrim($formatted, '.0');
    }
}
