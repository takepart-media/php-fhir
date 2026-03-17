<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Medication\MedicationBatch;
use Takepartdev\LaravelFhir\DataTypes\Medication\MedicationIngredient;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Ratio;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class MedicationResource extends AbstractResource
{
    protected string $name = 'Medication';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_INACTIVE = 'inactive';

    public const string STATUS_ENTERED_IN_ERROR = 'entered-in-error';

    public const array STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_ENTERED_IN_ERROR,
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

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $status): void
    {
        if ($this->validateInArray($status, self::STATUSES, "$this->name.status")) {
            $this->values['status'] = $status;
        } else {
            $this->values['hiddenProperties']['status'] = $status;
        }
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    public function setManufacturer(Reference $manufacturer): void
    {
        $this->values['manufacturer'] = $manufacturer;
    }

    public function setForm(CodeableConcept $form): void
    {
        $this->values['form'] = $form;
    }

    public function setAmount(Ratio $amount): void
    {
        $this->values['amount'] = $amount;
    }

    public function setIngredient(MedicationIngredient $ingredient): void
    {
        $this->initArrayProperty('ingredient');
        $this->values['ingredient'][] = $ingredient;
    }

    public function setBatch(MedicationBatch $batch): void
    {
        $this->values['batch'] = $batch;
    }
}
