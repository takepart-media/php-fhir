<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class EventHandling extends AbstractResource
{
    protected string $name = 'EventHandling';

    public function __construct()
    {
        parent::__construct();
    }

    public function setEvent(CodeableConcept $event): void
    {
        $this->values['event'] = $event;
    }

    public function setGroup(CodeableConcept $group): void
    {
        $this->values['group'] = $group;
    }

    public function setHandling(CodeableConcept $handling): void
    {
        $this->values['handling'] = $handling;
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
