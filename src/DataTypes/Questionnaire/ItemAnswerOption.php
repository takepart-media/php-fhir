<?php

namespace Takepartdev\LaravelFhir\DataTypes\Questionnaire;

use Takepartdev\LaravelFhir\DataTypes\Coding;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class ItemAnswerOption extends InternalResource
{
    protected string $name = 'ItemAnswerOption';

    public function __construct()
    {
        parent::__construct();
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
    public function setValueReference(Reference $reference): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueReference")) {
            $this->values['reference'] = $reference;
        } else {
            $this->values['hiddenProperties']['valueReference'] = $reference;
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
    public function setInitialSelected($initialSelected): void
    {
        if ($this->validateBoolean($initialSelected, "$this->name.initialSelected")) {
            $this->values['initialSelected'] = $initialSelected;
        } else {
            $this->values['hiddenProperties']['initialSelected'] = $initialSelected;
        }
    }
}
