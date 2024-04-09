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

  <footer class="footer">

    <article>
        <h4>Golf de Sainte-Agathe </h4>
        <ul>
          <li><a href="">Le parcours</li>
          <li><a href="">Infos pratiques</a></li>
          <li><a href="">Enseignement</a></li>
          <li><a href=""></a></li>
          
        </ul>
      </article>
      <article>
        <h4>Support </h4>
        <ul>
          <li><a href="">Online Support</a></li>
          <li><a href="">Call numbers</a></li>
          <li><a href="">E-mails</a></li>
          <li><a href="">Social Support</a></li>
          <li><a href="">Location</a></li>
        </ul>
      </article>
      
      <article>
        <h4>Permalinks</h4>
        <ul>
            
            <li><a href="#">Nos services</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Avis</a></li>
        </ul>
      </article>
    </div>
    <div class="footer__copyright">
      <small>Copyright &copy;,  Gcompet 2024 </small>
    </div>
  </footer>