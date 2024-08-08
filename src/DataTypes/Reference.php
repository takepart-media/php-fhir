<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Reference extends AbstractResource
{
    protected string $name = 'Reference';

    public function setReference(string $reference): void
    {
        $this->values['reference'] = $reference;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $uri): void
    {
        if ($this->validateUri($uri, 'Reference.type')) {
            $this->values['type'] = $uri;
        } else {
            $this->values['hiddenProperties']['type'] = $uri;
        }
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->values['identifier'] = $identifier;
    }

    public function setDisplay(string $display): void
    {
        $this->values['display'] = $display;
    }
}
