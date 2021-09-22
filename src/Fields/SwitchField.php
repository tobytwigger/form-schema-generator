<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class SwitchField extends Field
{

    protected string $onText = 'On';

    protected string $offText = 'Off';

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'onText' => $this->getOnText(),
            'offText' => $this->getOffText()
        ];
    }

    /**
     * @return string
     */
    public function getOnText(): string
    {
        return $this->onText;
    }

    /**
     * @param string $onText
     * @return SwitchField
     */
    public function setOnText(string $onText): SwitchField
    {
        $this->onText = $onText;
        return $this;
    }

    /**
     * @return string
     */
    public function getOffText(): string
    {
        return $this->offText;
    }

    /**
     * @param string $offText
     * @return SwitchField
     */
    public function setOffText(string $offText): SwitchField
    {
        $this->offText = $offText;
        return $this;
    }

    public function getType(): string
    {
        return 'switch';
    }
}
