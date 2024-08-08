<?php

namespace Takepartdev\LaravelFhir;

use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class InternalResource extends AbstractResource
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->values['id'])) {
            unset($this->values['id']);
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setId(string $id): void
    {
        throw new GenericFhirValidationException('You cannot set the id of an internal resource.');
    }
}
