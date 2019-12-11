<?php

namespace FormSchema\Schema;

class Group
{

    private $fields = [];

    private $legend;

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    public function fields()
    {
        return $this->fields;
    }

    public function setLegend(string $legend = '')
    {
        $this->legend = $legend;
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        return array_filter([
            'legend' => $this->legend,
            'fields' => array_map(function(Field $field) {
                return $field->toArray();
            }, $this->fields)
        ], function ($val) {
            return !is_null($val);
        });

    }

}