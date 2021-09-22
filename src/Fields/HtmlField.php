<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class HtmlField extends Field
{

    /**
     * TinyMCE API key for the HTML editor.
     *
     * @var string
     */
    protected $apiKey = null;

    /**
     * @inheritDoc
     */
    public function getAppendedAttributes(): array
    {
       return [
           'apiKey' => $this->apiKey
       ];
    }

    /**
     * @param string $apiKey
     * @return HtmlField
     */
    public function setApiKey(string $apiKey): HtmlField
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getType(): string
    {
        return 'html';
    }
}
