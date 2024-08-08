<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class RelatedArtifact extends AbstractResource
{
    protected string $name = 'RelatedArtifact';

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
    public function setType(string $code): void
    {
        if ($this->validateInArray($code, [
            'documentation',
            'justification',
            'citation',
            'predecessor',
            'successor',
            'derived-from',
            'depends-on',
            'composed-of',
            'part-of',
            'amends',
            'amended-with',
            'appends',
            'appended-with',
            'cites',
            'cited-by',
            'comments-on',
            'comment-in',
            'contains',
            'contained-in',
            'corrects',
            'correction-in',
            'replaces',
            'replaced-with',
            'retracts',
            'retracted-by',
            'signs',
            'similar-to',
            'supports',
            'supported-with',
            'transforms',
            'transformed-into',
            'transformed-with',
            'documents',
            'specification-of',
            'created-with',
            'cite-as',
        ], 'RelatedArtifact.type')) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }

    public function setClassifier(CodeableConcept $classifier): void
    {
        $this->initArrayProperty('classifier');
        $this->values['classifier'][] = $classifier;
    }

    public function setLabel(string $label): void
    {
        $this->values['label'] = $label;
    }

    public function setDisplay(string $display): void
    {
        $this->values['display'] = $display;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCitation(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, 'RelatedArtifact.citation')) {
            $this->values['citation'] = $markdown;
        } else {
            $this->values['hiddenProperties']['citation'] = $markdown;
        }
    }

    public function setDocument(Attachment $document): void
    {
        $this->values['document'] = $document;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setResource(string $canonical): void
    {
        if ($this->validateUri($canonical, 'RelatedArtifact.resource')) {
            $this->values['resource'] = $canonical;
        } else {
            $this->values['hiddenProperties']['resource'] = $canonical;
        }
    }

    public function setResourceReference(Reference $reference): void
    {
        $this->values['resourceReference'] = $reference;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPublicationStatus(string $code): void
    {
        if ($this->validateInArray($code, ['draft', 'active', 'retired', 'unknown'], 'RelatedArtifact.publicationStatus')) {
            $this->values['publicationStatus'] = $code;
        } else {
            $this->values['hiddenProperties']['publicationStatus'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPublicationDate(string $dateString): void
    {
        if ($this->validateDate($dateString, 'RelatedArtifact.publicationDate')) {
            $this->values['publicationDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['publicationDate'] = $dateString;
        }
    }
}
