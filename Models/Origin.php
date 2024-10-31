<?php

namespace Models;

/**
 * Classe Origin
 *
 * Représente une origine avec des propriétés et des méthodes pour les manipuler.
 */
class Origin
{
    /**
     * @var int $id
     * L'ID de l'origine.
     */
    private int $id;

    /**
     * @var string $name
     * Le nom de l'origine.
     */
    private string $name;

    /**
     * @var string $url_img
     * L'URL de l'image de l'origine.
     */
    private string $url_img;

    /**
     * Constructeur de la classe Origin.
     *
     * @param string $name
     * Le nom de l'origine (par défaut une chaîne vide).
     * @param string $url_img
     * L'URL de l'image de l'origine (par défaut une chaîne vide).
     */
    public function __construct(string $name = '', string $url_img = '')
    {
        $this->name = $name;
        $this->url_img = $url_img;
    }

    /**
     * Hydrate l'origine avec les données d'un tableau.
     *
     * @param array $data
     * Les données pour hydrater l'origine.
     *
     * @return void
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

    /**
     * Obtient l'ID de l'origine.
     *
     * @return int L'ID de l'origine.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Définit l'ID de l'origine.
     *
     * @param int $id
     * L'ID à définir.
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Obtient le nom de l'origine.
     *
     * @return string Le nom de l'origine.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Définit le nom de l'origine.
     *
     * @param string $name
     * Le nom à définir.
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Obtient l'URL de l'image de l'origine.
     *
     * @return string L'URL de l'image de l'origine.
     */
    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    /**
     * Définit l'URL de l'image de l'origine.
     *
     * @param string $url_img
     * L'URL à définir.
     *
     * @return void
     */
    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }
}
