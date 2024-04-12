
<?php 
   include 'partials/header.php' ;

    $query = "SELECT * FROM evenements WHERE is_active=1";
    $evenements = mysqli_query($connection,$query);
    
     

   ?>

 

    <!-- -----------------------------------------FIN DE LA NAV ---------------------------------------------------->


    <div class="search-bar">
        <input type="text" placeholder="Rechercher...">
        <button type="button">Rechercher</button>
      </div>
      <div class="event-grid">
        <?php while($evenement = mysqli_fetch_assoc($evenements)) : ?>
          <div class="event-card" style="background-image: url('./images/events/<?php echo $evenement['image'] ?>');">
          <h3><?=$evenement['nom'] ?></h3>
          <p><?=$evenement['categorie']?></p>
          <p>Places restantes: <?=$evenement['places_disponibles']?></p>
          <a href="<?=ROOT_URL?>event.php?id=<?= $evenement['id']?>"><button>En savoir plus</button></a>
        </div>
          <?php endwhile ?>
       
        <!-- Répéter pour 8 autres cartes d'événements -->
      </div>

      <?php 
   include 'partials/footer.php'
   ?>