<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Annotation;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Condition\ConditionAbatement;
use Takepartdev\LaravelFhir\DataTypes\Condition\ConditionEvidence;
use Takepartdev\LaravelFhir\DataTypes\Condition\ConditionOnset;
use Takepartdev\LaravelFhir\DataTypes\Condition\ConditionStage;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ConditionResource extends AbstractResource
{
    protected string $name = 'Condition';

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
    }

    public function setMeta(Meta $meta): void
    {
        $this->values['meta'] = $meta;
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    public function setClinicalStatus(CodeableConcept $clinicalStatus): void
    {
        $this->values['clinicalStatus'] = $clinicalStatus;
    }

    public function setVerificationStatus(CodeableConcept $verificationStatus): void
    {
        $this->values['verificationStatus'] = $verificationStatus;
    }

    public function setCategory(CodeableConcept $category): void
    {
        $this->initArrayProperty('category');
        $this->values['category'][] = $category;
    }

    public function setSeverity(CodeableConcept $severity): void
    {
        $this->values['severity'] = $severity;
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    public function setBodySite(CodeableConcept $bodySite): void
    {
        $this->initArrayProperty('bodySite');
        $this->values['bodySite'][] = $bodySite;
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setEncounter(Reference $encounter): void
    {
        $this->values['encounter'] = $encounter;
    }

    public function setOnset(ConditionOnset $onset): void
    {
        $this->values['onset'] = $onset;
    }

    public function setAbatement(ConditionAbatement $abatement): void
    {
        $this->values['abatement'] = $abatement;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setRecordedDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.recordedDate")) {
            $this->values['recordedDate'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['recordedDate'] = $dateTimeString;
        }
    }

    public function setRecorder(Reference $recorder): void
    {
        $this->values['recorder'] = $recorder;
    }

    public function setAsserter(Reference $asserter): void
    {
        $this->values['asserter'] = $asserter;
    }

    public function setStage(ConditionStage $stage): void
    {
        $this->initArrayProperty('stage');
        $this->values['stage'][] = $stage;
    }

    public function setEvidence(ConditionEvidence $evidence): void
    {
        $this->initArrayProperty('evidence');
        $this->values['evidence'][] = $evidence;
    }

    public function setNote(Annotation $note): void
    {
        $this->initArrayProperty('note');
        $this->values['note'][] = $note;
    }
}
