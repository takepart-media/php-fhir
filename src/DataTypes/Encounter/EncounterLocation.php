<?php

namespace Takepartdev\LaravelFhir\DataTypes\Encounter;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class EncounterLocation extends InternalResource
{
    protected string $name = 'EncounterLocation';

    public const string STATUS_PLANNED = 'planned';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_RESERVED = 'reserved';

    public const string STATUS_COMPLETED = 'completed';

    public const array ENCOUNTER_LOCATION_STATUSES = [
        self::STATUS_PLANNED,
        self::STATUS_ACTIVE,
        self::STATUS_RESERVED,
        self::STATUS_COMPLETED,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function setLocation(Reference $location): void
    {
        $this->values['location'] = $location;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $status): void
    {
        if ($this->validateInArray($status, self::ENCOUNTER_LOCATION_STATUSES, "$this->name.status")) {
            $this->values['status'] = $status;
        } else {
            $this->values['hiddenProperties']['status'] = $status;
        }
    }

    public function setForm(CodeableConcept $form): void
    {
        $this->values['form'] = $form;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }
}
