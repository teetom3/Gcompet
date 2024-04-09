<?php
require './config/database.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Gcompet</title>

</head>
<body>
    <header >
    
        
          <img class="logo_nav" src="./images/logo-png.png" alt="Logo">
       
        <nav class="nav_link">
          <ul>
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>accueil.php">Accueil</a></li>
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>event.php">Événement</a></li>
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>liste_joueurs.php">Liste des Joueurs</a></li>
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>mon_profil.php">Mon Profile</a></li>
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>logout.php">Déconnexion</a></li>
            <li class="open_nav"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M130-248v-75h700v75H130Zm0-195v-75h700v75H130Zm0-195v-75h700v75H130Z"/></svg></a></li>
          </ul>
          <?php if(isset($_SESSION['admin'])):?>
          <ul class="admin_nav">
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>admin/dashboard.php">Dashboard</a></li>
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>admin/event-form.php">Créer un Evenement</a></li>
            <li class="hideOnMobile"><a href="<?=ROOT_URL?>admin/manage-utilisateurs.php">Liste des Joueurs</a></li>
            </ul>
            <?php endif?>


        </nav>
        <nav class="sidebar">
          <ul>
            <li class="close_nav"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m259-206-52-53 220-221-220-221 52-53 221 221 221-221 52 53-220 221 220 221-52 53-221-221-221 221Z"/></svg></a></li>
            <li><a href="<?=ROOT_URL?>accueil.php">Accueil</a></li>
            <li><a href="<?=ROOT_URL?>event.php">Événement</a></li>
            <li><a href="<?=ROOT_URL?>liste_joueurs.php">Liste des Joueurs</a></li>
            <li><a href="<?=ROOT_URL?>mon_profil.php">Mon Profile</a></li>
            <?php if(isset($_SESSION['admin'])):?>
            <li><a href="<?=ROOT_URL?>admin/dashboard.php">Dashboard</a></li>
            <li><a href="<?=ROOT_URL?>admin/event-form.php">Créer un Evenement</a></li>
            <li><a href="<?=ROOT_URL?>admin/manage-utilisateurs.php">Liste des Joueurs</a></li>
            <?php endif?>
            <li><a href="<?=ROOT_URL?>logout.php">Déconnexion</a></li>
          </ul>
        </nav>

        
      
      
    </header>
   


    <!-- -----------------------------------------FIN DE LA NAV ---------------------------------------------------->