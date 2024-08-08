<?php

namespace Takepartdev\LaravelFhir\DataTypes\ServiceRequest;

use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class PatientInstruction extends InternalResource
{
    protected string $name = 'PatientInstruction';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setInstructionMarkdown(string $markdown): void
    {
        $this->validateOneOfThese('instruction');
        $this->validateMarkdown($markdown, 'Patient.Instruction.instructionMarkdown');
        $this->values['instructionMarkdown'] = $markdown;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setInstructionReference(Reference $reference): void
    {
        $this->validateOneOfThese('instruction');
        $this->values['instructionReference'] = $reference;
    }
}
