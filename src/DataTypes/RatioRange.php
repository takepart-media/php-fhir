<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class RatioRange extends AbstractResource
{
    protected string $name = 'RatioRange';

    public function __construct()
    {
        parent::__construct();
    }

    public function setLowNumerator(Quantity $lowNumerator): void
    {
        $this->values['lowNumerator'] = $lowNumerator;
    }

    public function setHighNumerator(Quantity $highNumerator): void
    {
        $this->values['highNumerator'] = $highNumerator;
    }

    public function setDenominator(Quantity $denominator): void
    {
        $this->values['denominator'] = $denominator;
    }
}
