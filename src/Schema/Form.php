<?php

namespace FormSchema\Schema;

/**
 * Represents a form
 * @package FormSchema\Schema
 */
class Form {

    /**
     * Hold all groups belonging to this form
     * @var array
     */
    private array $groups = [];

    private ?string $title = null;

    private ?string $subtitle = null;

    private ?string $description = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Form
     */
    public function setTitle(?string $title): Form
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param string|null $subtitle
     * @return Form
     */
    public function setSubtitle(?string $subtitle): Form
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Form
     */
    public function setDescription(?string $description): Form
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Add a group to the form
     *
     * @param Group $group
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    /**
     * Get all groups belonging to the form
     *
     * @return Group[]
     */
    public function groups()
    {
        return $this->groups;
    }

    /**
     * Output the schema representation of this form
     *
     * @return array
     */
    public function toArray()
    {
        return [
            array_map(fn (Group $group) => $group->toArray(), $this->groups()),
        ];
    }

    /**
     * Return the schema representation of the form as a json string
     *
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Return the schema representation of the form as a json string
     *
     * @return false|string
     */
    public function __toString()
    {
        return $this->toJson();
    }

}
