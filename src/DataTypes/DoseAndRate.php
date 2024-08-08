<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class DoseAndRate extends AbstractResource
{
    protected string $name = 'DoseAndRate';

    public function setType(CodeableConcept $type): void
    {
        $this->values['type'] = $type;
    }

    public function setDoseRange(Range $range): void
    {
        $this->values['doseRange'] = $range;
    }

    public function setDoseQuantity(Quantity $quantity): void
    {
        $this->values['doseQuantity'] = $quantity;
    }

    public function setRateRatio(Ratio $ratio): void
    {
        $this->values['rateRatio'] = $ratio;
    }

    public function setRateRange(Range $range): void
    {
        $this->values['rateRange'] = $range;
    }

    public function setRateQuantity(Quantity $quantity): void
    {
        $this->values['rateQuantity'] = $quantity;
    }
}
