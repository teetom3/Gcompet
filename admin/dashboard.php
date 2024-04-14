<?php 
   include 'partials/header.php';



  //fetch all post from database if id is set 

$query = "SELECT * FROM evenements WHERE is_active = 1 ORDER BY date_evenement DESC";
$evenements = mysqli_query($connection, $query);
?>


  



<?php if(isset($_SESSION['create-event-success'])): ?> <div class="alert__message-success">
            <p> 
                <?= $_SESSION['create-event-success'];
                unset($_SESSION['create-event-success'])?>
            </p>
        </div>
        <?php endif ?>
<div class="container">
    <div class="header">
      <h2>Liste des Événements (Admin)</h2>
    </div>
    <div class="event-list">
    <?php while($evenement= mysqli_fetch_assoc($evenements)) : ?>
      <div class="event-item">
        <div class="event-info">
          <h3><?=$evenement['nom']?></h3>
          <p><?=$evenement['date_evenement']?></p>
          <p><?=$evenement['categorie']?></p>
          <p><?=$evenement['places_disponibles']?></p>
        </div>
        <div class="actions">
          <a href="<?=ROOT_URL?>admin/manage-event.php?id=<?= $evenement['id']?>"><button class="open-button">Ouvrir</button></a>
          <a href="<?=ROOT_URL?>admin/delete-event.php?id=<?= $evenement['id']?>"><button class="delete-button">Supprimer</button></a>
        </div>
      </div>
      <?php endwhile?>
      <!-- Ajoutez plus d'éléments .event-item pour plus d'événements -->
    </div>
  </div>
<?php
  include 'partials/footer.php';
  ?>