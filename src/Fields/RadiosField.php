<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class RadiosField extends Field
{

    protected array $radios = [];

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'radios' => $this->getRadios()
        ];
    }

    public function withOption(string $id, string $text): RadiosField
    {
        $this->radios[] = [
            'id' => $id, 'text' => $text
        ];
        return $this;
    }

    public function setOptions(array $options): RadiosField
    {
        $this->radios = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getRadios(): array
    {
        return $this->radios;
    }

    public function getType(): string
    {
        return 'radios';
    }
}
