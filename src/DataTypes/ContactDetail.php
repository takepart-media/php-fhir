<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class ContactDetail extends AbstractResource
{
    protected string $name = 'ContactDetail';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setName(string $name): void
    {
        $this->values['name'] = $name;
    }

    public function setTelecom(ContactPoint $telecom): void
    {
        $this->initArrayProperty('telecom');
        $this->values['telecom'][] = $telecom;
    }
}
