<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchSubject;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class SubjectState extends AbstractResource
{
    protected string $name = 'SubjectState';

    public function __construct()
    {
        parent::__construct();
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStartDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.startDate")) {
            $this->values['startDate'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['startDate'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEndDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.endDate")) {
            $this->values['endDate'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['endDate'] = $dateTimeString;
        }
    }

    public function setReason(CodeableConcept $reason): void
    {
        $this->values['reason'] = $reason;
    }
}
