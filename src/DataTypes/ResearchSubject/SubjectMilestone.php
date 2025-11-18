<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchSubject;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class SubjectMilestone extends AbstractResource
{
    protected string $name = 'SubjectMilestone';

    public function __construct()
    {
        parent::__construct();
    }

    public function setMilestone(CodeableConcept $codeableConcept): void
    {
        $this->values['milestone'] = $codeableConcept;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.date")) {
            $this->values['date'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['date'] = $dateTimeString;
        }
    }

    public function setReason(CodeableConcept $codeableConcept): void
    {
        $this->initArrayProperty('reason');
        $this->values['reason'][] = $codeableConcept;
    }
}
