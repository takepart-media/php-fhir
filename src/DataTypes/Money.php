<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Money extends AbstractResource
{
    protected string $name = 'Money';

    public function __construct()
    {
        parent::__construct();
    }

    public function setValue(float $value): void
    {
        $this->values['value'] = $value;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCurrency(string $code): void
    {
        if ($this->validateCode($code, 'Money.currency')) {
            $this->values['currency'] = $code;
        } else {
            $this->values['hiddenProperties']['currency'] = $code;
        }
    }
}
