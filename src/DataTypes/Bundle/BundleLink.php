<?php

namespace Takepartdev\LaravelFhir\DataTypes\Bundle;

use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class BundleLink extends InternalResource
{
    protected string $name = 'BundleLink';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setRelation(string $code): void
    {
        if ($this->validateCode($code, "$this->name.relation")) {
            $this->values['relation'] = $code;
        } else {
            $this->values['hiddenProperties']['relation'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUrl(string $uri): void
    {
        if ($this->validateUri($uri, "$this->name.url")) {
            $this->values['url'] = $uri;
        } else {
            $this->values['hiddenProperties']['url'] = $uri;
        }
    }
}
