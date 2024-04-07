<?php
require_once 'Modele.php';

$modele = new Modele('mvc_users', 'root', '');

$utilisateurs = $modele->getUtilisateurs();
error_log("Données reçues dans le contrôleur : " . print_r($utilisateurs, true), 0);

// Récupération des données pour le graphique
$inscriptionsParMois = $modele->getInscriptionsParMois();
error_log("Données reçues dans le contrôleur : " . print_r($inscriptionsParMois, true), 0);

include 'Vue.php';
?>
