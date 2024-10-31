<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Managers\UnitManager;
use Views\constructor;

/**
 * Classe MainController
 *
 * Cette classe gère la logique de l'affichage de la page d'accueil.
 */
class MainController
{
    /**
     * @var Engine $templates
     * Instance de l'engine de templates pour le rendu des vues.
     */
    private Engine $templates;

    /**
     * @var UnitManager $unitManager
     * Manager des unités pour interagir avec les données des unités.
     */
    private UnitManager $unitManager;

    /**
     * Constructeur de la classe MainController.
     *
     * Initialise l'engine de templates et le manager des unités.
     */
    public function __construct()
    {
        $this->templates = new Engine('./Views');
        $this->unitManager = new UnitManager();
    }

    /**
     * Affiche la page d'accueil.
     *
     * Récupère toutes les unités et les affiche sous forme de cartes.
     * Si une erreur survient lors de la récupération des données, affiche une notification d'erreur.
     *
     * @return void
     */
    public function index(): void
    {
        $all = $this->unitManager->getAll();
        if (is_bool($all)) {
            $this->indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }

        $units = $all;
        $cardsHtml = constructor::createAllUnitCards($units);
        echo $this->templates->render('home', ['cardsHtml' => $cardsHtml, 'message' => '']);
    }

    /**
     * Affiche la page d'accueil avec une notification.
     *
     * Récupère toutes les unités et les affiche sous forme de cartes avec une notification.
     * Si une erreur survient lors de la récupération des données, affiche une notification d'erreur.
     *
     * @param string $text
     * Le texte de la notification à afficher.
     *
     * @return void
     */
    public function indexWithNotification(string $text): void
    {
        $all = $this->unitManager->getAll();
        if (is_bool($all)) {
            $this->indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }

        $units = $all;
        $cardsHtml = constructor::createAllUnitCards($units);
        echo $this->templates->render('home', [
            'cardsHtml' => $cardsHtml,
            'notificationHtml' => constructor::createMessageNotification($text)
        ]);
    }
}
