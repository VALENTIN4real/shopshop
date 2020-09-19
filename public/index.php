<?php

/* initialisation des fichiers TWIG */

require_once '../lib/vendor/autoload.php';
require_once '../src/controleur/_controleurs.php';
require_once '../config/routes.php';
require_once '../config/parametres.php';
require_once '../config/connexion.php';
require_once '../src/modele/_classes.php';

$loader = new \Twig\Loader\FilesystemLoader('../src/vue/');
$twig = $twig = new \Twig\Environment($loader, []);
$db = connect($config);
$contenu = getPage($db);
$contenu($twig,$db);

?>