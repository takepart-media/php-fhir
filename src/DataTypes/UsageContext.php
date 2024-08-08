<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class UsageContext extends AbstractResource
{
    protected string $name = 'UsageContext';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setCode(Coding $code): void
    {
        $this->values['code'] = $code;
    }

    public function setValueCodeableConcept(CodeableConcept $cConcept): void
    {
        $this->values['valueCodeableConcept'] = $cConcept;
    }

    public function setValueQuantity(Quantity $quantity): void
    {
        $this->values['valueQuantity'] = $quantity;
    }

    public function setValueRange(Range $range): void
    {
        $this->values['valueRange'] = $range;
    }

    public function setValueReference(Reference $reference): void
    {
        $this->values['valueReference'] = $reference;
    }
}
