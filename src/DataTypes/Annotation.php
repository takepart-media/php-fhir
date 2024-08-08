<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Annotation extends AbstractResource
{
    protected string $name = 'Annotation';

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setAuthorReference(Reference $author): void
    {
        $this->values['authorReference'] = $author;
    }

    public function setAuthorString(string $author): void
    {
        $this->values['authorString'] = $author;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTime(string $timeString): void
    {
        if ($this->validateTime($timeString, 'Annotation.time')) {
            $this->values['time'] = $timeString;
        } else {
            $this->values['hiddenProperties']['time'] = $timeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setText(string $text): void
    {
        if ($this->validateMarkdown($text, 'Annotation.text')) {
            $this->values['text'] = $text;
        } else {
            $this->values['hiddenProperties']['text'] = $text;
        }
    }
}
