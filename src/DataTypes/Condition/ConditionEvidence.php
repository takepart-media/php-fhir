<?php

namespace Takepartdev\LaravelFhir\DataTypes\Condition;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\InternalResource;

class ConditionEvidence extends InternalResource
{
    protected string $name = 'ConditionEvidence';

    public function __construct()
    {
        parent::__construct();
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->initArrayProperty('code');
        $this->values['code'][] = $code;
    }

    public function setDetail(Reference $detail): void
    {
        $this->initArrayProperty('detail');
        $this->values['detail'][] = $detail;
    }
}
