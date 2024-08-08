<?php

namespace Takepartdev\LaravelFhir\DataTypes\ServiceRequest;

use Takepartdev\LaravelFhir\DataTypes\CodeableReference;
use Takepartdev\LaravelFhir\InternalResource;

class OrderDetail extends InternalResource
{
    protected string $name = 'OrderDetail';

    public function __construct()
    {
        parent::__construct();
    }

    public function setParameterFocus(CodeableReference $reference): void
    {
        $this->values['parameterFocus'] = $reference;
    }

    public function setParameter(OrderDetailParameter $parameter): void
    {
        $this->initArrayProperty('parameter');
        $this->values['parameter'][] = $parameter;
    }
}
