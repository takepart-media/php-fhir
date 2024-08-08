<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class TriggerDefinition extends AbstractResource
{
    protected string $name = 'TriggerDefinition';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $code): void
    {
        if ($this->validateInArray($code, [
            'named-event',
            'periodic',
            'data-changed',
            'data-added',
            'data-modified',
            'data-removed',
            'data-accessed',
            'data-access-ended',
        ], 'TriggerDefinition.type')) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }

    public function setName(string $name): void
    {
        $this->values['name'] = $name;
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSubscriptionTopic(string $canonical): void
    {
        if ($this->validateUri($canonical, 'TriggerDefinition.subscriptionTopic')) {
            $this->values['subscriptionTopic'] = $canonical;
        } else {
            $this->values['hiddenProperties']['subscriptionTopic'] = $canonical;
        }
    }

    public function setTimingTiming(Timing $timing): void
    {
        $this->values['timingTiming'] = $timing;
    }

    public function setTimingReference(Reference $reference): void
    {
        $this->values['timingReference'] = $reference;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTimingDate(string $dateString): void
    {
        if ($this->validateDate($dateString, 'TriggerDefinition.timingDate')) {
            $this->values['timingDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['timingDate'] = $dateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTimingDateTime(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'TriggerDefinition.timingDateTime')) {
            $this->values['timingDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['timingDateTime'] = $dateTimeString;
        }
    }

    public function setData(DataRequirement $data): void
    {
        $this->initArrayProperty('data');
        $this->values['data'][] = $data;
    }

    public function setCondition(Expression $expression): void
    {
        $this->values['expression'] = $expression;
    }
}
