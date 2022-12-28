<?php
    // On détruit la session pour déconnecter l'utilisateur
    session_start();
    session_destroy();
    header('Location: accueil.php');
?>