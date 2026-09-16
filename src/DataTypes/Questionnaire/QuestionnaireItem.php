<?php

namespace Takepartdev\LaravelFhir\DataTypes\Questionnaire;

use Takepartdev\LaravelFhir\DataTypes\Coding;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class QuestionnaireItem extends InternalResource
{
    protected string $name = 'QuestionnaireItem';

    public const string TYPE_GROUP = 'group';

    public const string TYPE_DISPLAY = 'display';

    public const string TYPE_BOOLEAN = 'boolean';

    public const string TYPE_DECIMAL = 'decimal';

    public const string TYPE_INTEGER = 'integer';

    public const string TYPE_DATE = 'date';

    public const string TYPE_DATE_TIME = 'dateTime';

    public const string TYPE_TIME = 'time';

    public const string TYPE_STRING = 'string';

    public const string TYPE_TEXT = 'text';

    public const string TYPE_URL = 'url';

    public const string TYPE_CODING = 'coding';

    public const string TYPE_ATTACHMENT = 'attachment';

    public const string TYPE_REFERENCE = 'reference';

    public const string TYPE_QUANTITY = 'quantity';

    public const string TYPE_CHOICE = 'choice';

    public const array ITEM_TYPES = [
        self::TYPE_GROUP,
        self::TYPE_DISPLAY,
        self::TYPE_BOOLEAN,
        self::TYPE_DECIMAL,
        self::TYPE_INTEGER,
        self::TYPE_DATE,
        self::TYPE_DATE_TIME,
        self::TYPE_TIME,
        self::TYPE_STRING,
        self::TYPE_TEXT,
        self::TYPE_URL,
        self::TYPE_CODING,
        self::TYPE_ATTACHMENT,
        self::TYPE_REFERENCE,
        self::TYPE_QUANTITY,
        self::TYPE_CHOICE,
    ];

    public const string ENABLE_BEHAVIOR_ALL = 'all';

    public const string ENABLE_BEHAVIOR_ANY = 'any';

    public const array ITEM_ENABLE_BEHAVIORS = [
        self::ENABLE_BEHAVIOR_ALL,
        self::ENABLE_BEHAVIOR_ANY,
    ];

    public const string DISABLED_DISPLAY_HIDDEN = 'hidden';

    public const string DISABLED_DISPLAY_PROTECTED = 'protected';

    public const array ITEM_DISABLED_DISPLAYS = [
        self::DISABLED_DISPLAY_HIDDEN,
        self::DISABLED_DISPLAY_PROTECTED,
    ];

    public const string ANSWER_CONSTRAINT_OPTIONS_ONLY = 'optionsOnly';

    public const string ANSWER_CONSTRAINT_OPTIONS_OR_TYPE = 'optionsOrType';

    public const string ANSWER_CONSTRAINT_OPTIONS_OR_STRING = 'optionsOrString';

    public const array ITEM_ANSWER_CONSTRAINTS = [
        self::ANSWER_CONSTRAINT_OPTIONS_ONLY,
        self::ANSWER_CONSTRAINT_OPTIONS_OR_TYPE,
        self::ANSWER_CONSTRAINT_OPTIONS_OR_STRING,
    ];

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

    public function setCode(Coding $coding): void
    {
        $this->initArrayProperty('code');
        $this->values['code'][] = $coding;
    }

    public function setPrefix(string $prefix): void
    {
        $this->values['prefix'] = $prefix;
    }

    public function setText(string $text): void
    {
        $this->values['text'] = $text;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $code): void
    {
        if ($this->validateInArray($code, self::ITEM_TYPES, "$this->name.type")) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }

    public function setEnableWhen(ItemEnableWhen $enableWhen): void
    {
        $this->initArrayProperty('enableWhen');
        $this->values['enableWhen'][] = $enableWhen;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEnableBehavior(string $code): void
    {
        if ($this->validateInArray($code, self::ITEM_ENABLE_BEHAVIORS, "$this->name.enableBehavior")) {
            $this->values['enableBehavior'] = $code;
        } else {
            $this->values['hiddenProperties']['enableBehavior'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDisabledDisplay(string $code): void
    {
        if ($this->validateInArray($code, self::ITEM_DISABLED_DISPLAYS, "$this->name.disabledDisplay")) {
            $this->values['disabledDisplay'] = $code;
        } else {
            $this->values['hiddenProperties']['disabledDisplay'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setRequired($required): void
    {
        if ($this->validateBoolean($required, "$this->name.required")) {
            $this->values['required'] = $required;
        } else {
            $this->values['hiddenProperties']['required'] = $required;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setRepeats($repeats): void
    {
        if ($this->validateBoolean($repeats, "$this->name.repeat")) {
            $this->values['repeats'] = $repeats;
        } else {
            $this->values['hiddenProperties']['repeats'] = $repeats;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setReadOnly($readOnly): void
    {
        if ($this->validateBoolean($readOnly, "$this->name.readOnly")) {
            $this->values['readOnly'] = $readOnly;
        } else {
            $this->values['hiddenProperties']['readOnly'] = $readOnly;
        }
    }

    public function setMaxLength(int $maxLength): void
    {
        $this->values['maxLength'] = $maxLength;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerConstraint(string $code): void
    {
        if ($this->validateInArray($code, self::ITEM_ANSWER_CONSTRAINTS, "$this->name.answerConstraint")) {
            $this->values['answerConstraint'] = $code;
        } else {
            $this->values['hiddenProperties']['answerConstraint'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerValueSet(string $canonical): void
    {
        if ($this->validateUri($canonical, "$this->name.answerValueSet")) {
            $this->values['answerValueSet'] = $canonical;
        } else {
            $this->values['hiddenProperties']['answerValueSet'] = $canonical;
        }
    }

    public function setAnswerOption(ItemAnswerOption $answerOption): void
    {
        $this->initArrayProperty('answerOption');
        $this->values['answerOption'][] = $answerOption;
    }

    public function setInitial(ItemInitial $initial): void
    {
        $this->initArrayProperty('initial');
        $this->values['initial'][] = $initial;
    }

    public function setItem(QuestionnaireItem $item): void
    {
        $this->initArrayProperty('item');
        $this->values['item'][] = $item;
    }
}
