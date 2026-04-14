<?php

namespace Takepartdev\LaravelFhir\DataTypes\Condition;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\InternalResource;

class ConditionStage extends InternalResource
{
    protected string $name = 'ConditionStage';

    public function __construct()
    {
        parent::__construct();
    }

    public function setSummary(CodeableConcept $summary): void
    {
        $this->values['summary'] = $summary;
    }

    public function setAssessment(Reference $assessment): void
    {
        $this->initArrayProperty('assessment');
        $this->values['assessment'][] = $assessment;
    }

    public function setType(CodeableConcept $type): void
    {
        $this->values['type'] = $type;
    }
}
