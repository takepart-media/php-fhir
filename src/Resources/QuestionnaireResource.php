<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Coding;
use Takepartdev\LaravelFhir\DataTypes\ContactDetail;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Questionnaire\QuestionnaireItem;
use Takepartdev\LaravelFhir\DataTypes\UsageContext;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class QuestionnaireResource extends AbstractResource
{
    protected string $name = 'Questionnaire';

    public const string STATUS_DRAFT = 'draft';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_RETIRED = 'retired';

    public const string STATUS_UNKNOWN = 'unknown';

    public const array QUESTIONNAIRE_STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_RETIRED,
        self::STATUS_ACTIVE,
        self::STATUS_UNKNOWN,
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

    public function setImplicitRules(string $implicitRules): void
    {
        $this->values['implicitRules'] = $implicitRules;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLanguage(string $language): void
    {
        if ($this->validateCode($language, 'Questionnaire.language')) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }

    public function setText(Narrative $text): void
    {
        $this->values['text'] = $text;
    }

    public function setContained(array $contained): void
    {
        $this->initArrayProperty('contained');
        $this->values['contained'][] = $contained;
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setModifierExtension(Extension $modifierExtension): void
    {
        $this->initArrayProperty('modifierExtension');
        $this->values['modifierExtension'][] = $modifierExtension;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUrl(string $uri): void
    {
        if ($this->validateUri($uri, 'Questionnaire.uri')) {
            $this->values['url'] = $uri;
        } else {
            $this->values['hiddenProperties']['uri'] = $uri;
        }
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    public function setVersion(string $version): void
    {
        $this->values['version'] = $version;
    }

    public function setVersionAlgorithmString(string $versionAlgorithmString): void
    {
        if (isset($this->values['versionAlgorithmCoding'])) {
            unset($this->values['versionAlgorithmCoding']);
        }
        $this->values['versionAlgorithmString'] = $versionAlgorithmString;
    }

    public function setVersionAlgorithmCoding(string $versionAlgorithmCoding): void
    {
        if (isset($this->values['versionAlgorithmString'])) {
            unset($this->values['versionAlgorithmString']);
        }
        $this->values['versionAlgorithmCoding'] = $versionAlgorithmCoding;
    }

    public function setName(string $name): void
    {
        $this->values['name'] = $name;
    }

    public function setTitle(string $title): void
    {
        $this->values['title'] = $title;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDerivedFrom(string $canonical): void
    {
        if ($this->validateUri($canonical, 'Questionnaire.derivedFrom')) {
            $this->values['derivedFrom'] = $canonical;
        } else {
            $this->values['hiddenProperties']['derivedFrom'] = $canonical;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $code): void
    {
        if ($this->validateInArray($code, self::QUESTIONNAIRE_STATUSES, 'Questionnaire.status')) {
            $this->values['status'] = $code;
        } else {
            $this->values['hiddenProperties']['status'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setExperimental($experimental): void
    {
        if ($this->validateBoolean($experimental, "$this->name.experimental")) {
            $this->values['experimental'] = $experimental;
        } else {
            $this->values['hiddenProperties']['experimental'] = $experimental;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSubjectType(string $code): void
    {
        if ($this->validateCode($code, 'Questionnaire.subjectType')) {
            $this->initArrayProperty('subjectType');
            $this->values['subjectType'][] = $code;
        } else {
            $this->values['hiddenProperties']['subjectType'][] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'Questionnaire.date')) {
            $this->values['date'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['date'] = $dateTimeString;
        }
    }

    public function setPublisher(string $publisher): void
    {
        $this->values['publisher'] = $publisher;
    }

    public function setContact(ContactDetail $contactDetail): void
    {
        $this->initArrayProperty('contact');
        $this->values['contact'][] = $contactDetail;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDescription(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, 'Questionnaire.description')) {
            $this->values['description'] = $markdown;
        } else {
            $this->values['hiddenProperties']['description'] = $markdown;
        }
    }

    public function setUseContext(UsageContext $usageContext): void
    {
        $this->initArrayProperty('usageContext');
        $this->values['usageContext'][] = $usageContext;
    }

    public function setJurisdiction(CodeableConcept $jurisdiction): void
    {
        $this->initArrayProperty('jurisdiction');
        $this->values['jurisdiction'][] = $jurisdiction;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPurpose(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, 'Questionnaire.purpose')) {
            $this->values['purpose'] = $markdown;
        } else {
            $this->values['hiddenProperties']['purpose'] = $markdown;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCopyright(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, 'Questionnaire.copyright')) {
            $this->values['copyright'] = $markdown;
        } else {
            $this->values['hiddenProperties']['copyright'] = $markdown;
        }
    }

    public function setCopyrightLabel(string $copyrightLabel): void
    {
        $this->values['copyrightLabel'] = $copyrightLabel;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setApprovalDate(string $dateString): void
    {
        if ($this->validateDate($dateString, 'Questionnaire.approvalDate')) {
            $this->values['approvalDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['approvalDate'] = $dateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLastReviewDate(string $dateString): void
    {
        if ($this->validateDate($dateString, 'Questionnaire.lastReviewDate')) {
            $this->values['lastReviewDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['lastReviewDate'] = $dateString;
        }
    }

    public function setEffectivePeriod(Period $period): void
    {
        $this->values['effectivePeriod'] = $period;
    }

    public function setCode(Coding $coding): void
    {
        $this->initArrayProperty('code');
        $this->values['code'][] = $coding;
    }

    public function setItem(QuestionnaireItem $item): void
    {
        $this->initArrayProperty('item');
        $this->values['item'][] = $item;
    }
}
