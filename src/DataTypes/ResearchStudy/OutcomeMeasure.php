<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class OutcomeMeasure extends AbstractResource
{
    protected string $name = 'OutcomeMeasure';

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

    public function setEndpoint(Reference $endpoint): void
    {
        $this->values['endpoint'] = $endpoint;
    }

    public function setPopulation(Reference $population): void
    {
        $this->values['population'] = $population;
    }

    public function setIntervention(Reference $intervention): void
    {
        $this->values['intervention'] = $intervention;
    }

    public function setComparator(Reference $comparator): void
    {
        $this->values['comparator'] = $comparator;
    }

    public function setSummaryMeasure(CodeableConcept $summaryMeasure): void
    {
        $this->values['summaryMeasure'] = $summaryMeasure;
    }

    public function setEndpointAnalysisPlan(Reference $endpointAnalysisPlan): void
    {
        $this->values['endpointAnalysisPlan'] = $endpointAnalysisPlan;
    }

    public function setEventHandling(EventHandling $eventHandling): void
    {
        $this->initArrayProperty('eventHandling');
        $this->values['eventHandling'][] = $eventHandling;
    }
}
