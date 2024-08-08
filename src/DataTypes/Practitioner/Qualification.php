<?php

namespace Takepartdev\LaravelFhir\DataTypes\Practitioner;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\InternalResource;

class Qualification extends InternalResource
{
    protected string $name = 'Qualification';

    public function __construct()
    {
        parent::__construct();
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }

    public function setIssuer(Reference $issuer): void
    {
        $this->values['issuer'] = $issuer;
    }
}
