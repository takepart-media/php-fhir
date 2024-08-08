<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class Range extends AbstractResource
{
    protected string $name = 'Range';

    public function __construct()
    {
        parent::__construct();
    }

    public function setLow(Quantity $low): void
    {
        $this->values['low'] = $low;
    }

    public function setHigh(Quantity $high): void
    {
        $this->values['high'] = $high;
    }
}
