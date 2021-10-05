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
    private array $fields = [];

    /**
     * Holds the title for the group
     *
     * @var string
     */
    private ?string $title = null;

    /**
     * Holds the subtitle for the group
     *
     * @var string
     */
    private ?string $subtitle = null;

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
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Group
     */
    public function setTitle(string $title): Group
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     * @return Group
     */
    public function setSubtitle(string $subtitle): Group
    {
        $this->subtitle = $subtitle;
        return $this;
    }

}
