<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Attachment extends AbstractResource
{
    protected string $name = 'Attachment';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setContentType(string $code): void
    {
        if ($this->validateCode($code, 'Attachment.type')) {
            $this->values['contentType'] = $code;
        } else {
            $this->values['hiddenProperties']['contentType'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLanguage(string $language): void
    {
        if ($this->validateLanguage($language, 'Attachment.language')) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setData(string $base64String): void
    {
        if ($this->validateBase64($base64String, 'Attachment.data')) {
            $this->values['data'] = $base64String;
        } else {
            $this->values['hiddenProperties']['data'] = $base64String;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUrl(string $url): void
    {
        if ($this->validateUrl($url, 'Attachment.url')) {
            $this->values['url'] = $url;
        } else {
            $this->values['hiddenProperties']['url'] = $url;
        }
    }

    public function setSize(int $size): void
    {
        $this->values['size'] = $size;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setHash(string $hash): void
    {
        if ($this->validateBase64($hash, 'Attachment.hash')) {
            $this->values['hash'] = $hash;
        } else {
            $this->values['hiddenProperties']['hash'] = $hash;
        }
    }

    public function setTitle(string $title): void
    {
        $this->values['title'] = $title;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCreation(string $dateString): void
    {
        if ($this->validateDateTime($dateString, 'Attachment.creation')) {
            $this->values['creation'] = $dateString;
        } else {
            $this->values['hiddenProperties']['creation'] = $dateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setHeight(int $height): void
    {
        if ($this->validateInteger($height, '>', 0, 'Attachment.height')) {
            $this->values['height'] = $height;
        } else {
            $this->values['hiddenProperties']['height'] = $height;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setWidth(int $width): void
    {
        if ($this->validateInteger($width, '>', 0, 'Attachment.width')) {
            $this->values['width'] = $width;
        } else {
            $this->values['hiddenProperties']['width'] = $width;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setFrames(int $frames): void
    {
        if ($this->validateInteger($frames, '>', 1, 'Attachment.frames')) {
            $this->values['frames'] = $frames;
        } else {
            $this->values['hiddenProperties']['frames'] = $frames;
        }
    }

    public function setDuration(float $duration): void
    {
        $this->values['duration'] = $duration;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPages(int $pages): void
    {
        if ($this->validateInteger($pages, '>', 0, 'Attachment.pages')) {
            $this->values['pages'] = $pages;
        } else {
            $this->values['hiddenProperties']['pages'] = $pages;
        }
    }
}
