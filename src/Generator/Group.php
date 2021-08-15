<?php

namespace FormSchema\Generator;

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
    public static function make(?string $title = null, ?string $subtitle = null)
    {
        $groupSchema = new GroupSchema();
        if($title !== null) {
            $groupSchema->setTitle($title);
        }
        if($subtitle !== null) {
            $groupSchema->setSubtitle($subtitle);
        }
        return new static($groupSchema);
    }

    /**
     * Set the group legend
     *
     * @param string $legend Legend for the group
     * @return $this
     */
    public function title(string $title)
    {
        $this->group->setTitle($title);
        return $this;
    }

    /**
     * Set the group legend
     *
     * @param string $legend Legend for the group
     * @return $this
     */
    public function subtitle(string $subtitle)
    {
        $this->group->setSubtitle($subtitle);
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
