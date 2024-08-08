<?php

namespace Takepartdev\LaravelFhir\DataTypes\QuestionnaireResponse;

use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class QuestionnaireResponseItem extends InternalResource
{
    protected string $name = 'QuestionnaireResponseItem';

    public function __construct()
    {
        parent::__construct();
    }

    public function setLinkId(string $linkId): void
    {
        $this->values['linkId'] = $linkId;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDefinition(string $uri): void
    {
        if ($this->validateUri($uri, "$this->name.definition")) {
            $this->values['definition'] = $uri;
        } else {
            $this->values['hiddenProperties']['definition'] = $uri;
        }
    }

    public function setText(string $text): void
    {
        $this->values['text'] = $text;
    }

    public function setAnswerOption(ItemAnswer $answer): void
    {
        $this->initArrayProperty('answer');
        $this->values['answer'][] = $answer;
    }

    public function setItem(QuestionnaireResponseItem $item): void
    {
        $this->initArrayProperty('item');
        $this->values['item'][] = $item;
    }
}
