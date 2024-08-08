<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class NotAvailableTime extends AbstractResource
{
    protected string $name = 'NotAvailableTime';

    public function __construct()
    {
        parent::__construct();
    }

    public function setDescription(string $description): void
    {
        $this->values['description'] = $description;
    }

    public function setDuring(Period $period): void
    {
        $this->values['during'] = $period;
    }
}
