<?php

namespace App\Service;

class OlderCalculator
{
    /**
     * Calculation age following date of birth
     *
     * @param \DateTime $birthday
     * @return int
     */
    public function Older(\DateTime $birthday): int
    {
        $today = new \DateTime();
        $age    = $today->diff($birthday, true)->y;
        return $age;
    }
}
