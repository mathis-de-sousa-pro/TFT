<?php

namespace Config;

use Exception;

/**
 * Classe Config
 *
 * Cette classe gère la configuration de l'application en chargeant les paramètres
 * depuis des fichiers INI. Elle permet de récupérer la valeur d'un paramètre de configuration.
 */
class Config
{
    /**
     * @var array|false $param Tableau des paramètres de configuration ou false si non chargé
     */
    private static array|false $param;

    /**
     * Renvoie la valeur d'un paramètre de configuration
     *
     * @param string $nom Nom du paramètre de configuration
     * @param mixed|null $valeurParDefaut Valeur par défaut si le paramètre n'est pas trouvé
     * @return mixed Valeur du paramètre de configuration ou valeur par défaut
     * @throws Exception Si aucun fichier de configuration n'est trouvé
     */
    public static function get(string $nom, mixed $valeurParDefaut = null): mixed
    {
        if (isset(self::getParameter()[$nom]))
        {
            $valeur = self::getParameter()[$nom];
        }
        else
        {
            $valeur = $valeurParDefaut;
        }
        return $valeur;
    }

    /**
     * Renvoie le tableau des paramètres en le chargeant au besoin
     *
     * @return array|false Tableau des paramètres de configuration ou false si non chargé
     * @throws Exception Si aucun fichier de configuration n'est trouvé
     */
    private static function getParameter(): false|array
    {
        if (self::$param == null)
        {
            $cheminFichier = "Config/prod.ini";
            if (! file_exists($cheminFichier))
            {
                $cheminFichier = "Config/dev.ini";
            }
            if (! file_exists($cheminFichier))
            {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else
            {
                self::$param = parse_ini_file($cheminFichier);
            }
        }
        return self::$param;
    }
}