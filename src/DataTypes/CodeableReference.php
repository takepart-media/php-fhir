<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class CodeableReference extends AbstractResource
{
    protected string $name = 'CodeableReference';

    public function __construct()
    {
        parent::__construct();
    }

    public function setConcept(CodeableConcept $concept): void
    {
        $this->values['concept'] = $concept;
    }

    public function setReference(Reference $reference): void
    {
        $this->values['reference'] = $reference;
    }
}
