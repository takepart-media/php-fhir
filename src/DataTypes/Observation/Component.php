<?php

namespace Takepartdev\LaravelFhir\DataTypes\Observation;

use Takepartdev\LaravelFhir\DataTypes\Attachment;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Range;
use Takepartdev\LaravelFhir\DataTypes\Ratio;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\DataTypes\SampledData;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class Component extends InternalResource
{
    protected string $name = 'Component';

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
    public function setValueQuantity(Quantity $valueQuantity): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueQuantity")) {
            $this->values['valueQuantity'] = $valueQuantity;
        } else {
            $this->values['hiddenProperties']['valueQuantity'] = $valueQuantity;
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
    public function setValueString(string $valueString): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueString")) {
            $this->values['valueString'] = $valueString;
        } else {
            $this->values['hiddenProperties']['valueString'] = $valueString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueBoolean($valueBoolean): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueBoolean") &&
            $this->validateBoolean($valueBoolean, "$this->name.valueBoolean")) {
            $this->values['valueBoolean'] = $valueBoolean;
        } else {
            $this->values['hiddenProperties']['valueBoolean'] = $valueBoolean;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueInteger(int $valueInteger): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueInteger")) {
            $this->values['valueInteger'] = $valueInteger;
        } else {
            $this->values['hiddenProperties']['valueInteger'] = $valueInteger;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueRange(Range $valueRange): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueRange")) {
            $this->values['valueRange'] = $valueRange;
        } else {
            $this->values['hiddenProperties']['valueRange'] = $valueRange;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueRatio(Ratio $valueRatio): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueRatio")) {
            $this->values['valueRatio'] = $valueRatio;
        } else {
            $this->values['hiddenProperties']['valueRatio'] = $valueRatio;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueSampledData(SampledData $valueSampledData): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueSampledData")) {
            $this->values['valueSampledData'] = $valueSampledData;
        } else {
            $this->values['hiddenProperties']['valueSampledData'] = $valueSampledData;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueTime(string $valueTime): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueTime") &&
            $this->validateTime($valueTime, "$this->name.valueTime")) {
            $this->values['valueTime'] = $valueTime;
        } else {
            $this->values['hiddenProperties']['valueTime'] = $valueTime;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueDateTime(string $valueDateTime): void
    {
        if ($this->validateDateTime($valueDateTime, "$this->name.valueDateTime") &&
            $this->validateDateTime($valueDateTime, "$this->name.valueDateTime")) {
            $this->values['valueDateTime'] = $valueDateTime;
        } else {
            $this->values['hiddenProperties']['valueDateTime'] = $valueDateTime;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValuePeriod(Period $valuePeriod): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valuePeriod")) {
            $this->values['valuePeriod'] = $valuePeriod;
        } else {
            $this->values['hiddenProperties']['valuePeriod'] = $valuePeriod;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueAttachment(Attachment $valueAttachment): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueAttachment")) {
            $this->values['valueAttachment'] = $valueAttachment;
        } else {
            $this->values['hiddenProperties']['valueAttachment'] = $valueAttachment;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueReference(Reference $valueReference): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueReference")) {
            $this->values['valueReference'] = $valueReference;
        } else {
            $this->values['hiddenProperties']['valueReference'] = $valueReference;
        }
    }

    public function setDataAbsentReason(CodeableConcept $dataAbsentReason): void
    {
        $this->values['dataAbsentReason'] = $dataAbsentReason;
    }

    public function setInterpretation(CodeableConcept $interpretation): void
    {
        $this->initArrayProperty('interpretation');
        $this->values['interpretation'][] = $interpretation;
    }

    public function setReferenceRange(ReferenceRange $referenceRange): void
    {
        $this->initArrayProperty('referenceRange');
        $this->values['referenceRange'][] = $referenceRange;
    }
}
