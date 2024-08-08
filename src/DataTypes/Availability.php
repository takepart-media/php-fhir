<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class Availability extends AbstractResource
{
    protected string $name = 'Availability';

    public function __construct()
    {
        parent::__construct();
    }

    public function setAvailableTime(AvailableTime $time): void
    {
        $this->initArrayProperty('availableTime');
        $this->values['availableTime'][] = $time;
    }

    public function setNotAvailableTime(NotAvailableTime $time): void
    {
        $this->initArrayProperty('notAvailableTime');
        $this->values['notAvailableTime'][] = $time;
    }
}
