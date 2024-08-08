<?php

namespace Takepartdev\LaravelFhir\DataTypes\Encounter;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\CodeableReference;
use Takepartdev\LaravelFhir\InternalResource;

class EncounterReason extends InternalResource
{
    protected string $name = 'EncounterReason';

    public function __construct()
    {
        parent::__construct();
    }

    public function setUse(CodeableConcept $cConcept): void
    {
        $this->initArrayProperty('use');
        $this->values['use'][] = $cConcept;
    }

    public function setValue(CodeableReference $cReference): void
    {
        $this->initArrayProperty('value');
        $this->values['value'][] = $cReference;
    }
}
