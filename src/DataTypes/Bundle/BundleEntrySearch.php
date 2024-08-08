<?php

namespace Takepartdev\LaravelFhir\DataTypes\Bundle;

use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class BundleEntrySearch extends InternalResource
{
    protected string $name = 'BundleEntrySearch';

    public const string MODE_MATCH = 'match';

    public const string MODE_INCLUDE = 'include';

    public const array SEARCH_MODES = [
        self::MODE_INCLUDE,
        self::MODE_MATCH,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setMode(string $code): void
    {
        if ($this->validateInArray($code, self::SEARCH_MODES, "$this->name.mode")) {
            $this->values['mode'] = $code;
        } else {
            $this->values['hiddenProperties']['mode'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setScore(float $score): void
    {
        if ($this->validateDecimal($score, '>=', 0, "$this->name.score") &&
            $this->validateDecimal($score, '<=', 1, "$this->name.score")) {
            $this->values['score'] = $score;
        } else {
            $this->values['hiddenProperties']['score'] = $score;
        }
    }
}
