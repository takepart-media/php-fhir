<?php

namespace Takepartdev\LaravelFhir\DataTypes\Observation;

use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class TriggeredBy extends InternalResource
{
    protected string $name = 'TriggeredBy';

    public const string TRIGGERED_BY_REFLEX = 'reflex';

    public const string TRIGGERED_BY_REPEAT = 'repeat';

    public const string TRIGGERED_BY_RE_RUN = 're-run';

    public const array TRIGGERED_BY_TYPES = [
        self::TRIGGERED_BY_REFLEX,
        self::TRIGGERED_BY_REPEAT,
        self::TRIGGERED_BY_RE_RUN,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function setObservation(Reference $observation): void
    {
        $this->values['observation'] = $observation;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $code): void
    {
        $this->validateInArray($code, self::TRIGGERED_BY_TYPES, "$this->name.type");
        $this->values['type'] = $code;
    }

    public function setReason(string $reason): void
    {
        $this->values['reason'] = $reason;
    }
}
