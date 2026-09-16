<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class ExtendedContactDetail extends AbstractResource
{
    protected string $name = 'ExtendedContactDetail';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setPurpose(CodeableConcept $concept): void
    {
        $this->values['purpose'] = $concept;
    }

    public function setName(HumanName $humanName): void
    {
        $this->initArrayProperty('name');
        $this->values['name'][] = $humanName;
    }

    public function setTelecom(ContactPoint $contactPoint): void
    {
        $this->initArrayProperty('telecom');
        $this->values['telecom'][] = $contactPoint;
    }

    public function setAddress(Address $address): void
    {
        $this->values['address'] = $address;
    }

    public function setOrganization(Reference $organization): void
    {
        $this->values['organization'] = $organization;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }
}
