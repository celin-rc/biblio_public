<?php
session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/livres.controller.php";
$livresController = new LivresController;

require_once "controllers/auteurs.controller.php";
$auteursController = new AuteursController;

try 
{
   
    if (empty($_GET['page'])) 
    {
        require_once "views/accueil.view.php";
    }
    else
    {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
       /* echo "<pre>";
        print_r($url);
        echo "</pre>";*/
        switch ($url[0]) {
            case 'accueil':
                require_once "views/accueil.view.php";
                break;

            case 'livres':
                if (empty($url[1])) 
                {
                    $livresController->afficherLivres(); 
                }elseif($url[1] === "voire")
                {
                   echo $livresController->afficherLivre($url[2]); 
                }
                elseif($url[1] === "ajouter")
                {
                   echo $livresController->ajouterLivre();
                }
                elseif($url[1] === "post-livre")
                {
                   echo $livresController->validationPostLivre();
                }
                elseif($url[1] === "supprimer")
                {
                   echo $livresController->supprimerLivre($url[2]);
                }
                elseif($url[1] === "modifier")
                {
                   echo $livresController->modifierLivre($url[2]);
                }
                elseif($url[1] === "validerModification")
                {
                   echo $livresController->validationModifierLivre();
                }
                elseif($url[1] === "rechercher")
                {
                   echo $livresController->rechercherUnLivre();
                }
                else
                {
                    throw new Exception("La page n'existe pas encore.");   
                }
                break;

            case 'auteurs':
                if (empty($url[1])) 
                {
                    $auteursController->afficherAuteurs(); 
                }
                elseif($url[1] === "voire")
                {
                   echo $auteursController->afficherAuteur($url[2]); 
                }
                elseif($url[1] === "ajouter")
                {
                    echo $auteursController->ajouterAuteurs(); 
                }
                elseif($url[1] === "post-auteur")
                {
                    echo $auteursController->validationAuteurs(); 
                }
                elseif($url[1] === "supprimer")
                {
                    echo $auteursController->suppressionAuteurs($url[2]); 
                }
                elseif($url[1] === "modifier")
                {
                   echo $auteursController->modificationAuteurs($url[2]);
                }
                elseif($url[1] === "validerModification")
                {
                   echo $auteursController->validationModifierAuteur();
                }
                else
                {
                    throw new Exception("La page n'existe pas encore.");   
                }
                break;
            
            default:
                throw new Exception("La page n'existe pas encore.");
                break;
        }
    }

} 
catch (Exception $e) 
{
    $messageErreur = $e->getMessage();
    require "views/pageNotFound.view.php";
}
