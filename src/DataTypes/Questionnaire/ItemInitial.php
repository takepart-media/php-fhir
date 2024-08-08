<?php

namespace Takepartdev\LaravelFhir\DataTypes\Questionnaire;

use Takepartdev\LaravelFhir\DataTypes\Attachment;
use Takepartdev\LaravelFhir\DataTypes\Coding;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class ItemInitial extends InternalResource
{
    protected string $name = 'ItemInitial';

    public function __construct()
    {
        parent::__construct();
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
    public function setValueDecimal(float $valueDecimal): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueDecimal")) {
            $this->values['valueDecimal'] = $valueDecimal;
        } else {
            $this->values['hiddenProperties']['valueDecimal'] = $valueDecimal;
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
    public function setValueDate(string $dateString): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueDate") &&
            $this->validateDate($dateString, "$this->name.valueDate")) {
            $this->values['valueDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['valueDate'] = $dateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueDateTime(string $dateTimeString): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueDateTime") &&
            $this->validateDateTime($dateTimeString, "$this->name.valueDateTime")) {
            $this->values['valueDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['valueDateTime'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueTime(string $timeString): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueTime") &&
            $this->validateTime($timeString, "$this->name.valueTime")) {
            $this->values['valueTime'] = $timeString;
        } else {
            $this->values['hiddenProperties']['valueTime'] = $timeString;
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
    public function setValueUri(string $valueUri): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueUri") &&
            $this->validateUri($valueUri, "$this->name.valueUri")) {
            $this->values['valueUri'] = $valueUri;
        } else {
            $this->values['hiddenProperties']['valueUri'] = $valueUri;
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
    public function setValueCoding(Coding $valueCoding): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueCoding")) {
            $this->values['valueCoding'] = $valueCoding;
        } else {
            $this->values['hiddenProperties']['valueCoding'] = $valueCoding;
        }
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
    public function setValueReference(Reference $reference): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueReference")) {
            $this->values['reference'] = $reference;
        } else {
            $this->values['hiddenProperties']['reference'] = $reference;
        }
    }
}
