<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Coding extends AbstractResource
{
    protected string $name = 'Coding';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSystem(string $uri): void
    {
        if ($this->validateUri($uri, 'coding system')) {
            $this->values['system'] = $uri;
        } else {
            $this->values['hiddenProperties']['system'] = $uri;
        }
    }

    public function setVersion(string $version): void
    {
        $this->values['version'] = $version;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCode(string $code): void
    {
        if ($this->validateCode($code, 'coding code')) {
            $this->values['code'] = $code;
        } else {
            $this->values['hiddenProperties']['code'] = $code;
        }
    }

    public function setDisplay(string $display): void
    {
        $this->values['display'] = $display;
    }

    public function setExtension(Extension $extension): void
    {
        $this->initArrayProperty('extension');
        $this->values['extension'][] = $extension;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUserSelected($userSelected): void
    {
        if ($this->validateBoolean($userSelected)) {
            $this->values['userSelected'] = $userSelected;
        } else {
            $this->values['hiddenProperties']['userSelected'] = $userSelected;
        }
    }
}
