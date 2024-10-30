<?php

namespace Models;

/**
 * Class Unit
 * Represents a unit with various properties and methods to manipulate them.
 */
class Unit
{
    private ?string $id;
    private string $name;
    private int $cost;
    private string $url_img;
    private array $origins;

    /**
     * Get the ID of the unit.
     *
     * @return ?string The ID of the unit.
     */
    public function getId(): ?string
    {
        return $this->id;
    }


    public function __construct(
        ?string $id = null,
        string $name = '',
        int $cost = 0,
        string $url_img = '',
        array $origins = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->cost = $cost;
        $this->url_img = $url_img;
        $this->origins = $origins;
    }

    /**
     * Set the ID of the unit.
     *
     * @param ?string $id The ID to set.
     */
    public function setId(string $id = null): void
    {
        $this->id = $id;
    }

    /**
     * Get the name of the unit.
     *
     * @return string The name of the unit.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the unit.
     *
     * @param string $name The name to set.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the cost of the unit.
     *
     * @return int The cost of the unit.
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * Set the cost of the unit.
     *
     * @param int $cost The cost to set.
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * Get the URL of the unit's image.
     *
     * @return string The URL of the unit's image.
     */
    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    /**
     * Set the URL of the unit's image.
     *
     * @param string $url_img The URL to set.
     */
    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }

    public function getOrigins(): array
    {
        return $this->origins;
    }

    public function setOrigins(array $origins): void
    {
        $this->origins = $origins;
    }

    /**
     * Hydrate the unit with data from an array.
     *
     * @param array $data The data to hydrate the unit with.
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
        $this->url_img = $data['url_img'] ?? '';

    }
}