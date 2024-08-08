<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ParameterDefinition extends AbstractResource
{
    protected string $name = 'ParameterDefinition';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $ext): void
    {
        $this->values['extension'] = $ext;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setName(string $code): void
    {
        if ($this->validateCode($code, 'ParameterDefinition.name')) {
            $this->values['name'] = $code;
        } else {
            $this->values['hiddenProperties']['name'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUse(string $code): void
    {
        if ($this->validateInArray($code, ['in', 'out'], 'ParameterDefinition.use')) {
            $this->values['use'] = $code;
        } else {
            $this->values['hiddenProperties']['use'] = $code;
        }
    }

    public function setMin(string $min): void
    {
        $this->values['min'] = $min;
    }

    public function setMax(string $max): void
    {
        $this->values['max'] = $max;
    }

    public function setDocumentation(string $documentation): void
    {
        $this->values['documentation'] = $documentation;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $code): void
    {
        if ($this->validateCode($code, 'ParameterDefinition.type')) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setProfile(string $canonical): void
    {
        if ($this->validateUri($canonical, 'ParameterDefinition.profile')) {
            $this->values['profile'] = $canonical;
        } else {
            $this->values['hiddenProperties']['profile'] = $canonical;
        }
    }
}
