<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class CarResearch
{
    /**
     * @Assert\LessThanOrEqual(propertyPath="maxYear")
     */
    private $minYear;

    /**
     * @Assert\GreaterThanOrEqual(propertyPath="minYear")
     */
    private $maxYear;

    public function getMinYear()
    {
        return $this->minYear;
    }

    public function setMinYear($minYear)
    {
        $this->minYear = $minYear;
        return $this;
    }

    public function getMaxYear()
    {
        return $this->maxYear;
    }

    public function setMaxYear($maxYear)
    {
        $this->maxYear = $maxYear;
        return $this;
    }
}