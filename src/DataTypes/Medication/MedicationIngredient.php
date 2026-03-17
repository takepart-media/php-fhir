<?php

namespace Takepartdev\LaravelFhir\DataTypes\Medication;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Ratio;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class MedicationIngredient extends InternalResource
{
    protected string $name = 'MedicationIngredient';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->initArrayProperty('extension');
        $this->values['extension'][] = $extension;
    }

    public function setItemReference(Reference $itemReference): void
    {
        $this->values['itemReference'] = $itemReference;
    }

    public function setItemCodeableConcept(CodeableConcept $itemCodeableConcept): void
    {
        $this->values['itemCodeableConcept'] = $itemCodeableConcept;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setIsActive($isActive): void
    {
        if ($this->validateBoolean($isActive, "$this->name.isActive")) {
            $this->values['isActive'] = $isActive;
        } else {
            $this->values['hiddenProperties']['isActive'] = $isActive;
        }
    }

    public function setStrength(Ratio $strength): void
    {
        $this->values['strength'] = $strength;
    }

    public function setStrengthCodeableConcept(CodeableConcept $strengthCodeableConcept): void
    {
        $this->values['strengthCodeableConcept'] = $strengthCodeableConcept;
    }
}
