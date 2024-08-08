<?php

namespace Takepartdev\LaravelFhir\DataTypes\Encounter;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\InternalResource;

class EncounterAdmission extends InternalResource
{
    protected string $name = 'EncounterAdmission';

    public function __construct()
    {
        parent::__construct();
    }

    public function setPreAdmissionIdentifier(Identifier $identifier): void
    {
        $this->values['preAdmissionIdentifier'] = $identifier;
    }

    public function setOrigin(Reference $origin): void
    {
        $this->values['origin'] = $origin;
    }

    public function setAdmitSource(CodeableConcept $admitSource): void
    {
        $this->values['admitSource'] = $admitSource;
    }

    public function setReAdmission(CodeableConcept $reAdmission): void
    {
        $this->values['reAdmission'] = $reAdmission;
    }

    public function setDestination(Reference $destination): void
    {
        $this->values['destination'] = $destination;
    }

    public function setDischargeDisposition(CodeableConcept $dischargeDisposition): void
    {
        $this->values['dischargeDisposition'] = $dischargeDisposition;
    }
}
