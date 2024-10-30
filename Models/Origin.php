<?php

namespace Models;

class Origin
{
    private int $id;
    private string $name;
    private string $url_img;

    public function __construct(string $name = '', string $url_img = '')
    {
        $this->name = $name;
        $this->url_img = $url_img;
    }

    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        $this->url_img = $data['url_img'] ?? '';
    }

    // Getter et Setter pour id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter et Setter pour name
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // Getter et Setter pour url_img
    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }
}
