<?php

namespace Takepartdev\LaravelFhir\DataTypes\MedicationList;

use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class ListEntry extends InternalResource
{
    protected string $name = 'ListEntry';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDate(string $date): void
    {
        if ($this->validateDateTime($date, "$this->name.date")) {
            $this->values['date'] = $date;
        } else {
            $this->values['hiddenProperties']['date'] = $date;
        }
    }

    public function setItem(Reference $item): void
    {
        $this->values['item'] = $item;
    }
}
