<?php

namespace Takepartdev\LaravelFhir\DataTypes\Medication;

use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class MedicationBatch extends InternalResource
{
    protected string $name = 'MedicationBatch';

    public function __construct()
    {
        parent::__construct();
    }

    public function setLotNumber(string $lotNumber): void
    {
        $this->values['lotNumber'] = $lotNumber;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setExpirationDate(string $expirationDate): void
    {
        if ($this->validateDateTime($expirationDate, "$this->name.expirationDate")) {
            $this->values['expirationDate'] = $expirationDate;
        } else {
            $this->values['hiddenProperties']['expirationDate'] = $expirationDate;
        }
    }
}
