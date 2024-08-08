<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class PrependedPrimitive extends AbstractResource
{
    protected string $name = 'PrependedPrimitive';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->initArrayProperty('extension');
        $this->values['extension'][] = $extension;
    }

    public function setId(string $id): void
    {
        $this->values['id'] = $id;
    }
}
