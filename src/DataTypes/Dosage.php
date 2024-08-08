<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;

class Dosage extends AbstractResource
{
    protected string $name = 'Dosage';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setSequence(int $sequence): void
    {
        $this->values['sequence'] = $sequence;
    }

    public function setText(string $text): void
    {
        $this->values['text'] = $text;
    }

    public function setAdditionalInstruction(CodeableConcept $additionalInstruction): void
    {
        $this->initArrayProperty('additionalInstruction');
        $this->values['additionalInstruction'][] = $additionalInstruction;
    }

    public function setPatientInstruction(string $patientInstruction): void
    {
        $this->values['patientInstruction'] = $patientInstruction;
    }

    public function setTiming(Timing $timing): void
    {
        $this->values['timing'] = $timing;
    }

    public function setAsNeeded($asNeeded): void
    {
        if ($this->validateBoolean($asNeeded, 'Dosage.asNeeded')) {
            $this->values['asNeeded'] = $asNeeded;
        } else {
            $this->values['hiddenProperties']['asNeeded'] = $asNeeded;
        }
    }

    public function setAsNeededFor(CodeableConcept $asNeededFor): void
    {
        $this->initArrayProperty('asNeededFor');
        $this->values['asNeededFor'][] = $asNeededFor;
    }

    public function setSite(CodeableConcept $site): void
    {
        $this->values['site'] = $site;
    }

    public function setRoute(CodeableConcept $route): void
    {
        $this->values['route'] = $route;
    }

    public function setMethod(CodeableConcept $method): void
    {
        $this->values['method'] = $method;
    }

    public function setDoseAndRate(DoseAndRate $doseAndRate): void
    {
        $this->initArrayProperty('doseAndRate');
        $this->values['doseAndRate'][] = $doseAndRate;
    }

    public function setDosePerPeriod(Ratio $ratio): void
    {
        $this->initArrayProperty('dosePerPeriod');
        $this->values['dosePerPeriod'][] = $ratio;
    }

    public function setMaxDosePerAdministration(Quantity $maxDosePerAdministration): void
    {
        $this->values['maxDosePerAdministration'] = $maxDosePerAdministration;
    }

    public function setMaxDosePerLifeTime(Quantity $maxDosePerLifetime): void
    {
        $this->values['maxDosePerLifetime'] = $maxDosePerLifetime;
    }
}
