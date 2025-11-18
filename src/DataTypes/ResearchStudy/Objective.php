<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Objective extends AbstractResource
{
    protected string $name = 'Objective';

    public function __construct()
    {
        parent::__construct();
    }

    public function setName(string $name): void
    {
        $this->values['name'] = $name;
    }

    public function setType(CodeableConcept $type): void
    {
        $this->values['type'] = $type;
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

    public function setOutcomeMeasure(OutcomeMeasure $outcomeMeasure): void
    {
        $this->initArrayProperty('outcomeMeasure');
        $this->values['outcomeMeasure'][] = $outcomeMeasure;
    }
}
