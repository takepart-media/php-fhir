<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class DataRequirement extends AbstractResource
{
    protected string $name = 'DataRequirement';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $code): void
    {
        if ($this->validateCode($code, 'DataRequirement.type')) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setProfile(string $canonical): void
    {
        if ($this->validateUri($canonical, 'DataRequirement.profile')) {
            $this->values['profile'] = $canonical;
        } else {
            $this->values['hiddenProperties']['profile'] = $canonical;
        }
    }

    public function setSubjectCodeableConcept(CodeableConcept $concept): void
    {
        $this->values['subjectCodeableConcept'] = $concept;
    }

    public function setSubjectReference(Reference $reference): void
    {
        $this->values['subjectReference'] = $reference;
    }

    public function setMustSupport(string $support): void
    {
        $this->initArrayProperty('mustSupport');
        $this->values['mustSupport'][] = $support;
    }

    public function setCodeFilter(CodeFilter $filter): void
    {
        $this->initArrayProperty('codeFilter');
        $this->values['codeFilter'][] = $filter;
    }

    public function setDataFilter(DateFilter $filter): void
    {
        $this->initArrayProperty('dateFilter');
        $this->values['dateFilter'][] = $filter;
    }

    public function setValueFilter(ValueFilter $filter): void
    {
        $this->initArrayProperty('valueFilter');
        $this->values['valueFilter'][] = $filter;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLimit(int $limit): void
    {
        if ($this->validateInteger($limit, '>', 0, 'DataRequirement.limit')) {
            $this->values['limit'] = $limit;
        } else {
            $this->values['hiddenProperties']['limit'] = $limit;
        }
    }

    public function setSort(Sort $sort): void
    {
        $this->initArrayProperty('sort');
        $this->values['sort'][] = $sort;
    }
}
