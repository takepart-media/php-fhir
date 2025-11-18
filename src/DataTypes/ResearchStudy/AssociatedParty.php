<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;

class AssociatedParty extends AbstractResource
{
    protected string $name = 'AssociatedParty';

    public function __construct()
    {
        parent::__construct();
    }

    public function setName(string $name): void
    {
        $this->values['name'] = $name;
    }

    public function setRole(CodeableConcept $role): void
    {
        $this->values['role'] = $role;
    }

    public function setPeriod(Period $period): void
    {
        $this->initArrayProperty('period');
        $this->values['period'][] = $period;
    }

    public function setClassifier(CodeableConcept $classifier): void
    {
        $this->initArrayProperty('classifier');
        $this->values['classifier'][] = $classifier;
    }

    public function setParty(Reference $party): void
    {
        $this->values['party'] = $party;
    }
}
