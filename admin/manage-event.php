<?php 
   include 'partials/header.php';



   
   if(isset($_GET['id'])) {
       $id_evenement = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
       $query = "SELECT * FROM evenements WHERE id=$id_evenement";
       $query_result = mysqli_query($connection,$query);
       $evenement = mysqli_fetch_array($query_result);
        
   }
   ?>


      
      
    
<?php if(isset($_SESSION['inscription_success'])): ?> 
        <div class="alert__message-success">
            <p> 
                <?= $_SESSION['inscription_success'];
                unset($_SESSION['inscription_success'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['inscription_error'])): ?> 
        <div class="alert__message-error">
            <p> 
                <?= $_SESSION['inscription_error'];
                unset($_SESSION['inscription_error'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['desinscription_success'])): ?> 
        <div class="alert__message-success">
            <p> 
                <?= $_SESSION['desinscription_success'];
                unset($_SESSION['desinscription_success'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['desinscription_error'])): ?> 
        <div class="alert__message-error">
            <p> 
                <?= $_SESSION['desinscription_error'];
                unset($_SESSION['desinscription_error'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['message'])): ?> 
        <div class="alert__message-success">
            <p> 
                <?= $_SESSION['message'];
                unset($_SESSION['message'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['error'])): ?> 
        <div class="alert__message-error">
            <p> 
                <?= $_SESSION['error'];
                unset($_SESSION['error'])?>
            </p>
        </div>
        <?php endif ?>
    <div class="event-details">
        <div class="event-image">
          <img src="../images/events/<?=$evenement['image']?>" alt="Image de l'événement">
        </div>
        <div class="event-info">
          <h1><?=$evenement['nom']?></h1>
          <p><?=$evenement['description']?></p>
          <a href="<?=ROOT_URL?>admin/inscrire-logic-admin.php?id=<?= $evenement['id']?>"><button>S'inscrire</button></a>
          <a href="<?=ROOT_URL?>admin/recuperer-liste-mail.php?id=<?= $evenement['id']?>"><button>Recuperer les inscrits</button></a>
          <a href="<?=ROOT_URL?>admin/inscrire-joueurs.php?id=<?= $evenement['id']?>"><button>Inscrire des joueurs</button></a>
          <a href="<?=ROOT_URL?>admin/edit-event.php?id=<?= $evenement['id']?>"><button>Modifier</button></a>
        </div>
      </div>

      <?php 

$query = "SELECT users.id AS id_utilisateur, users.avatar, users.prenom, users.index_golf FROM inscriptions 
INNER JOIN users ON inscriptions.id_utilisateur = users.id
WHERE inscriptions.id_evenement = $id_evenement";

$result = mysqli_query($connection, $query);


      
      ?>
      <div class="container">
        <div class="header">
          <h2>Liste des Joueurs inscrits</h2>
        </div>
        <div class="search-bar">
          <input type="text" placeholder="Rechercher un joueur...">
        </div>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Avatar</th>
                <th>Prénom</th>
                <th>Index</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($user_inscrit = mysqli_fetch_assoc($result)) : ?>
              <tr>
                <td><img src="../images/<?php echo $user_inscrit['avatar'] ?>" alt="Avatar joueur 1"></td>
                <td><?=$user_inscrit['prenom']?></td>
                <td><?=$user_inscrit['index_golf']?></td>
                <td><a href="<?=ROOT_URL?>admin/desinscrire-joueurs-logic.php?id_evenement=<?=$id_evenement?>&id_utilisateur=<?=$user_inscrit['id_utilisateur']?>"><button>ANNULER</button></a></td>
              </tr>
              <?php endwhile?>
             
              <!-- Ajoutez plus de lignes pour plus de joueurs -->
            </tbody>
          </table>
        </div>
</div>
        
     <!--------------------------------------------DEBUT DU FOOTER ------------------------------------------------------------>
     <?php 
   include 'partials/footer.php';

   ?>