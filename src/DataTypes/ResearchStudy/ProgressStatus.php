<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ProgressStatus extends AbstractResource
{
    protected string $name = 'ProgressStatus';

    public function __construct()
    {
        parent::__construct();
    }

    public function setState(CodeableConcept $state): void
    {
        $this->values['state'] = $state;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setActual($actual): void
    {
        if ($this->validateBoolean($actual, "$this->name.actual")) {
            $this->values['actual'] = $actual;
        } else {
            $this->values['hiddenProperties']['actual'] = $actual;
        }
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }
}
