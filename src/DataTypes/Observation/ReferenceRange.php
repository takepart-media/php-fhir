<?php

namespace Takepartdev\LaravelFhir\DataTypes\Observation;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Range;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class ReferenceRange extends InternalResource
{
    protected string $name = 'ReferenceRange';

    public function __construct()
    {
        parent::__construct();
    }

    public function setLow(Quantity $low): void
    {
        $this->values['low'] = $low;
    }

    public function setHigh(Quantity $high): void
    {
        $this->values['high'] = $high;
    }

    public function setNormalValue(CodeableConcept $normalValue): void
    {
        $this->values['normalValue'] = $normalValue;
    }

    public function setType(CodeableConcept $type): void
    {
        $this->values['type'] = $type;
    }

    public function setAppliesTo(CodeableConcept $appliesTo): void
    {
        $this->initArrayProperty('appliesTo');
        $this->values['appliesTo'][] = $appliesTo;
    }

    public function setAge(Range $age): void
    {
        $this->values['age'] = $age;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setText(string $text): void
    {
        if ($this->validateMarkdown($text, 'ReferenceRange.text')) {
            $this->values['text'] = $text;
        } else {
            $this->values['hiddenProperties']['text'] = $text;
        }
    }
}
