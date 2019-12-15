<?php

namespace FormSchema\Generator;

use FormSchema\Schema\Field as FieldSchema;
use FormSchema\Schema\Group as GroupSchema;

/**
 * Helper to generate a group schema
 * 
 * Class Group
 * @package FormSchema\Generator
 */
class Group
{

    /**
     * Holds the group schema object
     * @var GroupSchema 
     */
    private $group;

    /**
     * @param GroupSchema $group
     */
    public function __construct(GroupSchema $group)
    {
        $this->group = $group;
    }

    /**
     * Makes a new instance of the Group generator
     * 
     * @return static
     */
    public static function make(?string $legend = null)
    {
        $groupSchema = new GroupSchema;
        if($legend !== null) {
            $groupSchema->setLegend($legend);
        }
        return new static($groupSchema);
    }

    /**
     * Set the group legend
     * 
     * @param string $legend Legend for the group
     * @return $this
     */
    public function legend(string $legend)
    {
        $this->group->setLegend($legend);
        return $this;
    }

    /**
     * Add a field to the group
     * 
     * @param Field $field
     * @return $this
     */
    public function withField(Field $field)
    {
        $this->group->addField($field->getSchema());
        return $this;
    }

    /**
     * Get the underlying schema instance
     * 
     * @return GroupSchema
     */
    public function getSchema()
    {
        return $this->group;
    }

}
