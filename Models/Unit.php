<?php

namespace Models;

/**
 * Classe Unit
 *
 * Représente une unité avec diverses propriétés et méthodes pour les manipuler.
 */
class Unit
{
    /**
     * @var ?string $id
     * L'ID de l'unité (peut être null).
     */
    private ?string $id;

    /**
     * @var string $name
     * Le nom de l'unité.
     */
    private string $name;

    /**
     * @var int $cost
     * Le coût de l'unité.
     */
    private int $cost;

    /**
     * @var string $url_img
     * L'URL de l'image de l'unité.
     */
    private string $url_img;

    /**
     * @var array $origins
     * Les origines de l'unité.
     */
    private array $origins;

    /**
     * Constructeur de la classe Unit.
     *
     * @param ?string $id
     * L'ID de l'unité (par défaut null).
     * @param string $name
     * Le nom de l'unité (par défaut une chaîne vide).
     * @param int $cost
     * Le coût de l'unité (par défaut 0).
     * @param string $url_img
     * L'URL de l'image de l'unité (par défaut une chaîne vide).
     * @param array $origins
     * Les origines de l'unité (par défaut un tableau vide).
     */
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
     * Obtient l'ID de l'unité.
     *
     * @return ?string L'ID de l'unité.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Définit l'ID de l'unité.
     *
     * @param ?string $id L'ID à définir.
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * Obtient le nom de l'unité.
     *
     * @return string Le nom de l'unité.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Définit le nom de l'unité.
     *
     * @param string $name Le nom à définir.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Obtient le coût de l'unité.
     *
     * @return int Le coût de l'unité.
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * Définit le coût de l'unité.
     *
     * @param int $cost Le coût à définir.
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * Obtient l'URL de l'image de l'unité.
     *
     * @return string L'URL de l'image de l'unité.
     */
    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    /**
     * Définit l'URL de l'image de l'unité.
     *
     * @param string $url_img L'URL à définir.
     */
    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }

    /**
     * Obtient les origines de l'unité.
     *
     * @return array Les origines de l'unité.
     */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /**
     * Définit les origines de l'unité.
     *
     * @param array $origins Les origines à définir.
     */
    public function setOrigins(array $origins): void
    {
        $this->origins = $origins;
    }

    /**
     * Hydrate l'unité avec les données d'un tableau.
     *
     * @param array $data Les données pour hydrater l'unité.
     */
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
}
