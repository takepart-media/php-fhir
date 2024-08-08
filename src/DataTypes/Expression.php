<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Expression extends AbstractResource
{
    protected string $name = 'Expression';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $ext): void
    {
        $this->values['extension'] = $ext;
    }

    public function setDescription(string $description): void
    {
        $this->values['description'] = $description;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLanguage(string $language): void
    {
        if ($this->validateCode($language, 'Expression.language')) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }

    public function setExpression(string $expression): void
    {
        $this->values['expression'] = $expression;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setReference(string $uri): void
    {
        if ($this->validateUri($uri, 'Expression.reference')) {
            $this->values['reference'] = $uri;
        } else {
            $this->values['hiddenProperties']['reference'] = $uri;
        }
    }
}
