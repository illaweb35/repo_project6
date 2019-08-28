<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [new TwigFilter('formatPhone', [$this, 'formatPhone']),];
    }

    public function formatPhone($value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);
        if (strlen($value) > 10) {
            $countryCode = substr($value, 0, strlen($value) - 10);
            $first = substr($value, -9, 1);
            $Two = substr($value, -8, 2);
            $three = substr($value, -6, 2);
            $four = substr($value, -4, 2);
            $five = substr($value, -2, 2);
            $value = '+' . $countryCode . ' ' . '(0)' . $first .  ' ' .  $Two . ' ' . $three . ' ' . $four . ' ' . $five;
        } else if (strlen($value) == 10) {
            $first = substr($value, 0, 2);
            $Two = substr($value, 2, 2);
            $three = substr($value, 4, 2);
            $four = substr($value, 6, 2);
            $five = substr($value, 8, 2);
            $value = $first . ' ' .  $Two . ' ' . $three . ' ' . $four . ' ' . $five;
        }

        return $value;
    }
}
