<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class AvailableTime extends AbstractResource
{
    protected string $name = 'AvailableTime';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDaysOfWeek(string $day): void
    {
        $this->initArrayProperty('daysOfWeek');

        if ($this->validateInArray($day, ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'], 'AvailableTime.daysOfWeek')) {
            $this->values['daysOfWeek'][] = $day;
        } else {
            $this->values['hiddenProperties']['daysOfWeek'][] = $day;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAllDay($allDay): void
    {
        if ($this->validateBoolean($allDay, 'AvailableTime.allDay')) {
            $this->values['allDay'] = $allDay;
        } else {
            $this->values['hiddenProperties']['allDay'] = $allDay;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAvailableStartTime(string $timeString): void
    {
        if ($this->validateTime($timeString, 'AvailableTime.availableStartTime')) {
            $this->values['availableStartTime'] = $timeString;
        } else {
            $this->values['hiddenProperties']['availableStartTime'] = $timeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAvailableEndTimeTime(string $timeString): void
    {
        if ($this->validateTime($timeString, 'AvailableTime.availableEndTimeTime')) {
            $this->values['availableEndTimeTime'] = $timeString;
        } else {
            $this->values['hiddenProperties']['availableEndTimeTime'] = $timeString;
        }
    }
}
