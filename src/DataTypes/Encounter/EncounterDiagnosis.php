<?php

namespace Takepartdev\LaravelFhir\DataTypes\Encounter;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\CodeableReference;
use Takepartdev\LaravelFhir\InternalResource;

class EncounterDiagnosis extends InternalResource
{
    protected string $name = 'EncounterDiagnosis';

    public function __construct()
    {
        parent::__construct();
    }

    public function setCondition(CodeableReference $cReference): void
    {
        $this->initArrayProperty('condition');
        $this->values['condition'][] = $cReference;
    }

    public function setUse(CodeableConcept $cConcept): void
    {
        $this->initArrayProperty('use');
        $this->values['use'][] = $cConcept;
    }
}
