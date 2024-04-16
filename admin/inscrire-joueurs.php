<?php 
   include 'partials/header.php';
   if(isset($_GET['id'])) {
    $id_evenement = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);}

   $query ="SELECT *
FROM users
WHERE id NOT IN (
    SELECT id_utilisateur
    FROM inscriptions
    WHERE id_evenement = $id_evenement
)";

$result = mysqli_query($connection, $query);
   ?>

<div class="container">
    <div class="header">
      <h2>Inscriptions des joueurs </h2>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Rechercher un joueur...">
    </div>
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
        <?php endif ?>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Avatar</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Index</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($user_none = mysqli_fetch_assoc($result)) :?>
          <tr>
            <td><img src="../images/<?php echo $user_none['avatar'] ?>" alt="Avatar joueur 1"></td>
            <td><?=$user_none['nom']?></td>
            <td><?=$user_none['prenom']?></td>
            <td><?=$user_none['email']?></td>
            <td><?=$user_none['index_golf']?></td>
            <td>
                <a href="<?=ROOT_URL?>admin/inscrire-joueurs-logic.php?id_evenement=<?=$id_evenement?>&id_utilisateur=<?=$user_none['id']?>"><button class="inscription-button">Inscrire</button></a>
            </td>
          </tr>
          <?php endwhile?>
        
          <!-- Ajoutez plus de lignes pour plus de joueurs -->
        </tbody>
      </table>
    </div>
          </div>
    <?php
  include 'partials/footer.php';
  ?>

    