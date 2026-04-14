<?php

namespace Takepartdev\LaravelFhir\DataTypes\Condition;

use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class ConditionOnset extends InternalResource
{
    protected string $name = 'ConditionOnset';

    public function __construct()
    {
        parent::__construct();
    }

    public function setOnsetPeriod(Period $onsetPeriod): void
    {
        $this->values['onsetPeriod'] = $onsetPeriod;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAbatementDateTime(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'ConditionOnset.onsetDateTime')) {
            $this->values['onsetDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['onsetDateTime'] = $dateTimeString;
        }
    }
}
