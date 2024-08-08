<?php

namespace Takepartdev\LaravelFhir\DataTypes\Questionnaire;

use Takepartdev\LaravelFhir\DataTypes\Coding;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class ItemEnableWhen extends InternalResource
{
    protected string $name = 'ItemEnableWhen';

    public const string OPERATOR_EQ = '=';

    public const string OPERATOR_NE = '!=';

    public const string OPERATOR_GT = '>';

    public const string OPERATOR_LT = '<';

    public const string OPERATOR_GTE = '>=';

    public const string OPERATOR_LTE = '<=';

    public const array ENABLE_WHEN_OPERATORS = [
        self::OPERATOR_EQ,
        self::OPERATOR_NE,
        self::OPERATOR_GT,
        self::OPERATOR_LT,
        self::OPERATOR_GTE,
        self::OPERATOR_LTE,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function setQuestion(string $linkId): void
    {
        $this->values['question'] = $linkId;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setOperator(string $operator): void
    {
        if ($this->validateInArray($operator, self::ENABLE_WHEN_OPERATORS, "$this->name.operator")) {
            $this->values['operator'] = $operator;
        } else {
            $this->values['hiddenProperties']['operator'] = $operator;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerBoolean($answerBoolean): void
    {
        if ($this->validateBoolean($answerBoolean, "$this->name.answerBoolean") &&
            $this->validateOneOfThese('answer')) {
            $this->values['answerBoolean'] = $answerBoolean;
        } else {
            $this->values['hiddenProperties']['answerBoolean'] = $answerBoolean;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerDecimal(float $answerDecimal): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerDecimal")) {
            $this->values['answerDecimal'] = $answerDecimal;
        } else {
            $this->values['hiddenProperties']['answerDecimal'] = $answerDecimal;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerInteger(int $answerInteger): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerInteger")) {
            $this->values['answerInteger'] = $answerInteger;
        } else {
            $this->values['hiddenProperties']['answerInteger'] = $answerInteger;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerDate(string $dateString): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerDate") &&
            $this->validateDate($dateString, "$this->name.answerDate")) {
            $this->values['answerDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['answerDate'] = $dateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerDateTime(string $dateTimeString): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerDateTime") &&
            $this->validateDateTime($dateTimeString, "$this->name.answerDateTime")) {
            $this->values['answerDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['answerDateTime'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerString(string $answerString): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerString")) {
            $this->values['answerString'] = $answerString;
        } else {
            $this->values['hiddenProperties']['answerString'] = $answerString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerCoding(Coding $answerCoding): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerCoding")) {
            $this->values['answerCoding'] = $answerCoding;
        } else {
            $this->values['hiddenProperties']['answerCoding'] = $answerCoding;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerQuantity(Quantity $answerQuantity): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerQuantity")) {
            $this->values['answerQuantity'] = $answerQuantity;
        } else {
            $this->values['hiddenProperties']['answerQuantity'] = $answerQuantity;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAnswerReference(Reference $answerReference): void
    {
        if ($this->validateOneOfThese('answer', "$this->name.answerReference")) {
            $this->values['answerReference'] = $answerReference;
        } else {
            $this->values['hiddenProperties']['answerReference'] = $answerReference;
        }
    }
}
