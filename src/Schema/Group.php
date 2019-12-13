<?php

namespace FormSchema\Schema;

/**
 * Represents a group of fields
 * 
 * @package FormSchema\Schema
 */
class Group
{

    /**
     * Holds the fields belonging to this group
     * 
     * @var Field[]
     */
    private $fields = [];

    /**
     * Holds the legend for the group
     * 
     * @var string
     */
    private $legend;

    /**
     * Add a field to the group
     * 
     * @param Field $field
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    /**
     * Get all fields belonging to the group
     * 
     * @return Field[]
     */
    public function fields()
    {
        return $this->fields;
    }

    /**
     * Set the legend of the group
     * 
     * @param string $legend
     */
    public function setLegend(string $legend = '')
    {
        $this->legend = $legend;
    }

    /**
     * Return a schema representation of the group as a json string
     * 
     * @return false|string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Return a schema representation of the group as a json string
     * 
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Return a schema representation of the group as an array
     * 
     * @return array
     */
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