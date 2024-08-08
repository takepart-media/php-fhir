<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\QuestionnaireResponse\QuestionnaireResponseItem;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class QuestionnaireResponseResource extends AbstractResource
{
    protected string $name = 'QuestionnaireResponse';

    public const string STATUS_IN_PROGRESS = 'in-progress';

    public const string STATUS_COMPLETED = 'completed';

    public const string STATUS_AMENDED = 'amended';

    public const string STATUS_ENTERED_IN_ERROR = 'entered-in-error';

    public const string STATUS_STOPPED = 'stopped';

    public const array QUESTIONNAIRE_RESPONSE_STATUSES = [
        self::STATUS_IN_PROGRESS,
        self::STATUS_COMPLETED,
        self::STATUS_AMENDED,
        self::STATUS_ENTERED_IN_ERROR,
        self::STATUS_STOPPED,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
    }

    public function setMeta(Meta $meta): void
    {
        $this->values['meta'] = $meta;
    }

    public function setImplicitRules(string $implicitRules): void
    {
        $this->values['implicitRules'] = $implicitRules;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLanguage(string $language): void
    {
        if ($this->validateCode($language, 'QuestionnaireResponse.language')) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }

    public function setText(Narrative $text): void
    {
        $this->values['text'] = $text;
    }

    public function setContained(array $contained): void
    {
        $this->initArrayProperty('contained');
        $this->values['contained'][] = $contained;
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setModifierExtension(Extension $modifierExtension): void
    {
        $this->initArrayProperty('modifierExtension');
        $this->values['modifierExtension'][] = $modifierExtension;
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    public function setBasedOn(Reference $basedOn): void
    {
        $this->initArrayProperty('basedOn');
        $this->values['basedOn'][] = $basedOn;
    }

    public function setPartOf(Reference $partOf): void
    {
        $this->initArrayProperty('partOf');
        $this->values['partOf'][] = $partOf;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setQuestionnaire(string $canonical): void
    {
        if ($this->validateUri($canonical, 'QuestionnaireResponse.questionnaire')) {
            $this->values['questionnaire'] = $canonical;
        } else {
            $this->values['hiddenProperties']['questionnaire'] = $canonical;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $code): void
    {
        if ($this->validateInArray($code, self::QUESTIONNAIRE_RESPONSE_STATUSES, 'QuestionnaireResponse.status')) {
            $this->values['status'] = $code;
        } else {
            $this->values['hiddenProperties']['status'] = $code;
        }
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setEncounter(Reference $encounter): void
    {
        $this->values['encounter'] = $encounter;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAuthored(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'QuestionnaireResponse.authored')) {
            $this->values['authored'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['authored'] = $dateTimeString;
        }
    }

    public function setAuthor(Reference $author): void
    {
        $this->values['author'] = $author;
    }

    public function setSource(Reference $source): void
    {
        $this->values['source'] = $source;
    }

    public function setItem(QuestionnaireResponseItem $item): void
    {
        $this->initArrayProperty('item');
        $this->values['item'][] = $item;
    }
}
