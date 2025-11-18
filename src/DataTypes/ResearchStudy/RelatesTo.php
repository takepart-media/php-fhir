<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Attachment;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class RelatesTo extends AbstractResource
{
    protected string $name = 'RelatesTo';

    public function __construct()
    {
        parent::__construct();
    }

    public function setType(CodeableConcept $type): void
    {
        $this->values['type'] = $type;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTargetUri(string $targetUri): void
    {
        if ($this->validateUri($targetUri, "$this->name.targetUri")) {
            $this->values['targetUri'] = $targetUri;
        } else {
            $this->values['hiddenProperties']['targetUri'] = $targetUri;
        }
    }

    public function setTargetAttachment(Attachment $targetAttachment): void
    {
        $this->values['targetAttachment'] = $targetAttachment;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTargetCanonical(string $canonical): void
    {
        if ($this->validateUri($canonical, "$this->name.targetCanonical")) {
            $this->values['targetCanonical'] = $canonical;
        } else {
            $this->values['hiddenProperties']['targetCanonical'] = $canonical;
        }
    }

    public function setTargetReference(Reference $reference): void
    {
        $this->values['targetReference'] = $reference;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTargetMarkdown(string $markdown): void
    {
        if ($this->validateUri($markdown, "$this->name.targetMarkdown")) {
            $this->values['targetMarkdown'] = $markdown;
        } else {
            $this->values['hiddenProperties']['targetMarkdown'] = $markdown;
        }
    }
}
