<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class CodeFilter extends AbstractResource
{
    protected string $name = 'CodeFilter';

    public function __construct()
    {
        parent::__construct();
    }

    public function setPath(string $path): void
    {
        $this->values['path'] = $path;
    }

    public function setSearchParam(string $param): void
    {
        $this->values['searchParam'] = $param;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueSet(string $canonical): void
    {
        if ($this->validateUri($canonical, 'CodeFilter.valueSet')) {
            $this->values['valueSet'] = $canonical;
        } else {
            $this->values['hiddenProperties']['valueSet'] = $canonical;
        }
    }

    public function setCode(Coding $coding): void
    {
        $this->initArrayProperty('code');
        $this->values['code'][] = $coding;
    }
}
