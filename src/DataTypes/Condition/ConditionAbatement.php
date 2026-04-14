<?php

namespace Takepartdev\LaravelFhir\DataTypes\Condition;

use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Range;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class ConditionAbatement extends InternalResource
{
    protected string $name = 'ConditionAbatement';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAbatementDateTime(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'ConditionAbatement.abatementDateTime')) {
            $this->values['abatementDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['abatementDateTime'] = $dateTimeString;
        }
    }

    public function setAbatementPeriod(Period $period): void
    {
        $this->values['abatementDateTime'] = $period;
    }

    public function setAbatementRange(Range $range): void
    {
        $this->values['abatementRange'] = $range;
    }

    public function setAbatementString(string $string): void
    {
        $this->values['abatementString'] = $string;
    }
}
