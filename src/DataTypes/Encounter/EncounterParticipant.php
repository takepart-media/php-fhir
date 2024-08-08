<?php

namespace Takepartdev\LaravelFhir\DataTypes\Encounter;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\InternalResource;

class EncounterParticipant extends InternalResource
{
    protected string $name = 'EncounterParticipant';

    public function __construct()
    {
        parent::__construct();
    }

    public function setType(CodeableConcept $type): void
    {
        $this->initArrayProperty('type');
        $this->values['type'][] = $type;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }

    public function setActor(Reference $actor): void
    {
        $this->values['actor'] = $actor;
    }
}
