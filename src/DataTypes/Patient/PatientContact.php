<?php

namespace Takepartdev\LaravelFhir\DataTypes\Patient;

use Takepartdev\LaravelFhir\DataTypes\Address;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\ContactPoint;
use Takepartdev\LaravelFhir\DataTypes\HumanName;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;
use Takepartdev\LaravelFhir\Resources\PatientResource;

class PatientContact extends InternalResource
{
    protected string $name = 'PatientContact';

    public function __construct()
    {
        parent::__construct();
    }

    public function setName(HumanName $humanName): void
    {
        $this->values['name'] = $humanName;
    }

    public function setTelecom(ContactPoint $contactPoint): void
    {
        $this->initArrayProperty('telecom');
        $this->values['telecom'][] = $contactPoint;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setGender(string $gender): void
    {
        if ($this->validateInArray($gender, PatientResource::PATIENT_GENDERS, 'PatientContact.gender')) {
            $this->values['gender'] = $gender;
        } else {
            $this->values['hiddenProperties']['gender'] = null;
        }
    }

    public function setAddress(Address $address): void
    {
        $this->values['address'] = $address;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }

    public function setRelationship(CodeableConcept $relationship): void
    {
        $this->initArrayProperty('relationship');
        $this->values['relationship'][] = $relationship;
    }

    public function setOrganization(Reference $organization): void
    {
        $this->values['organization'] = $organization;
    }
}
