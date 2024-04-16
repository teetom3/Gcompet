<?php 
   include 'partials/header.php';


  if(isset($_GET['id'])) {
    $event_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM evenements WHERE id=$event_id";
    $result = mysqli_query($connection, $query);
    $event= mysqli_fetch_assoc($result);
} else {
    header('Location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
  

   ?>

<div class="container">
    <div class="header">
      <h2>Modification de l'Evenement (Admin)</h2>
    </div>
    <?php if(isset($_SESSION['modification_success'])): ?> 
        <div class="alert__message-success">
            <p> 
                <?= $_SESSION['modification_success'];
                unset($_SESSION['modification_success'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['modification_error'])): ?> 
        <div class="alert__message-error">
            <p> 
                <?= $_SESSION['modification_error'];
                unset($_SESSION['modification_error'])?>
            </p>
        </div>
        <?php endif?>
    <div class="form-container">
      <form action="<?= ROOT_URL ?>admin/edit-event-logic.php?id=<?=$event_id?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nom">Nom de l'Événement :</label>
          <input type="text" id="nom" name="nom" value="<?=$event['nom']?>"required>
        </div>
        <div class="form-group">
          <label for="categorie">Catégorie de l'Événement :</label>
          <select id="categorie" name="categorie" value="<?=$event['categorie']?>" >
          <option value="competition" <?php if($event['categorie'] == "competition") echo "selected"; ?>>Compétition</option>
    <option value="cours" <?php if($event['categorie'] == "cours") echo "selected"; ?>>Cours</option>
    <option value="autre" <?php if($event['categorie'] == "autre") echo "selected"; ?>>Autre</option>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Description de l'Événement :</label>
          <textarea id="description" name="description" rows="4" required><?=$event['description']?></textarea>
        </div>
        <div class="form-group">
          <label for="date">Date de l'Événement :</label>
          <input type="date" id="date_evenement" name="date_evenement" value="<?=$event['date_evenement']?>"required>
        </div>
        <div class="form-group">
          <label for="places">Nombre de Places Disponibles :</label>
          <input type="number" id="places_disponibles" name="places_disponibles" required value="<?=$event['places_disponibles']?>">
        </div>
        <div class="form-group">
          <label for="image">Image de l'Événement (facultatif) :</label>
          <input type="file" id="image" name="image" value="<?=$event['image']?>">
        </div>
        <button type="submit" name="submit">Sauvegarder</button>
      </form>
      <a href="<?=ROOT_URL?>admin/manage-event.php?id=<?=$event_id?>"><button class="quit-button">Quitter</button></a>
    </div>
  </div>
  <?php
  include 'partials/footer.php';
  ?>