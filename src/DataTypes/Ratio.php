<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class Ratio extends AbstractResource
{
    protected string $name = 'Ratio';

    public function __construct()
    {
        parent::__construct();
    }

    public function setNumerator(Quantity $numerator): void
    {
        $this->values['numerator'] = $numerator;
    }

    public function setDenominator(Quantity $denominator): void
    {
        $this->values['denominator'] = $denominator;
    }
}
