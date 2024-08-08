<?php

namespace Takepartdev\LaravelFhir\DataTypes\ServiceRequest;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Range;
use Takepartdev\LaravelFhir\DataTypes\Ratio;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class OrderDetailParameter extends InternalResource
{
    protected string $name = 'Parameter';

    public function __construct()
    {
        parent::__construct();
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueQuantity(Quantity $quantity): void
    {
        $this->validateOneOfThese('value');
        $this->values['valueQuantity'] = $quantity;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueRatio(Ratio $ratio): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueRatio")) {
            $this->values['valueRatio'] = $ratio;
        } else {
            $this->values['hiddenProperties']['valueRatio'] = $ratio;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueRange(Range $range): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueRange")) {
            $this->values['valueRange'] = $range;
        } else {
            $this->values['hiddenProperties']['valueRange'] = $range;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueBoolean($boolean): void
    {
        if ($this->validateBoolean($boolean, "$this->name.valueBoolean") &&
            $this->validateOneOfThese('value', "$this->name.valueBoolean")) {
            $this->values['valueBoolean'] = $boolean;
        } else {
            $this->values['hiddenProperties']['valueBoolean'] = $boolean;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueCodeableConcept(CodeableConcept $codeableConcept): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueCodeableConcept")) {
            $this->values['valueCodeableConcept'] = $codeableConcept;
        } else {
            $this->values['hiddenProperties']['valueCodeableConcept'] = $codeableConcept;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueString(string $string): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueString")) {
            $this->values['value'] = $string;
        } else {
            $this->values['hiddenProperties']['value'] = $string;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValuePeriod(Period $period): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valuePeriod")) {
            $this->values['valuePeriod'] = $period;
        } else {
            $this->values['hiddenProperties']['valuePeriod'] = $period;
        }
    }
}
