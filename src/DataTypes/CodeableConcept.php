<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class CodeableConcept extends AbstractResource
{
    protected string $name = 'CodeableConcept';

    public function __construct()
    {
        parent::__construct();
    }

    public function setText(string $text): void
    {
        $this->values['text'] = $text;
    }

    public function setCoding(Coding $coding): void
    {
        $this->initArrayProperty('coding');
        $this->values['coding'][] = $coding;
    }
}
