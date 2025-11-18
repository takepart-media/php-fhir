<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Recruitment extends AbstractResource
{
    protected string $name = 'Recruitment';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTargetNumber(int $targetNumber): void
    {
        if ($this->validateInteger($targetNumber, '>=', 0)) {
            $this->values['targetNumber'] = $targetNumber;
        } else {
            $this->values['hiddenProperties']['targetNumber'] = $targetNumber;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setActualNumber(int $actualNumber): void
    {
        if ($this->validateInteger($actualNumber, '>=', 0)) {
            $this->values['actualNumber'] = $actualNumber;
        } else {
            $this->values['hiddenProperties']['actualNumber'] = $actualNumber;
        }
    }

    public function setEligibility(Reference $eligibility): void
    {
        $this->values['eligibility'] = $eligibility;
    }

    public function setActualGroup(Reference $actualGroup): void
    {
        $this->values['actualGroup'] = $actualGroup;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDescription(string $description): void
    {
        if ($this->validateMarkdown($description, "$this->name.description")) {
            $this->values['description'] = $description;
        } else {
            $this->values['hiddenProperties']['description'] = $description;
        }
    }
}
