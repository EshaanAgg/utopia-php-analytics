<?php

namespace Utopia\Analytics;

class Event
{
    /**
     * @var string (required)
     */
    private string $type = '';

    /**
     * @var string (required)
     */
    private string $url = '';

    /**
     * @var string (required)
     */
    private string $name = '';

    /**
     * @var string|null
     */
    private ?string $value = null;

    /**
     * @var array[]
     */
    private array $props = [];

    /**
     * Get the type of event
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the type of event
     *
     * @param  string  $type
     * @return Event
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the URL of the event
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the URL of the event
     *
     * @param  string  $url
     * @return Event
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the name of the event
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the event
     *
     * @param  string  $name
     * @return Event
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of the event
     *
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set the value of the event
     *
     * @param  string|null  $value
     * @return Event
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the properties of the event
     *
     * @return array[]
     */
    public function getProps(): array
    {
        return $this->props;
    }

    /**
     * Adds extra properties to the event
     *
     * @param  string  $key
     * @param  string  $value
     * @return Event
     */
    public function addProp(string $key, string $value): self
    {
        $this->props[$key] = $value;

        return $this;
    }

    /**
     * Removes a property from the event
     *
     * @param  string  $key
     * @return Event
     */
    public function removeProp(string $key): self
    {
        if (array_key_exists($key, $this->props)) {
            unset($this->props[$key]);
        }

        return $this;
    }

    /**
     * Get a property from the event
     *
     * @param  string  $key
     * @return string|null
     */
    public function getProp(string $key): ?string
    {
        if (array_key_exists($key, $this->props)) {
            return $this->props[$key];
        }

        return null;
    }

    /**
     * Set the properties of the event
     *
     * @param  array[]  $props
     * @return Event
     */
    public function setProps(array $props): self
    {
        $this->props = $props;

        return $this;
    }
}
