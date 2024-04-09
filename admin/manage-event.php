<?php 
   include 'partials/header.php';



   
   if(isset($_GET['id'])) {
       $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
       $query = "SELECT * FROM evenements WHERE id=$id";
       $query_result = mysqli_query($connection,$query);
       $evenement = mysqli_fetch_array($query_result);
        
   }
   ?>


      
      
    
        <div class="alert__message-succes">
          <p>
              Modifications sauvgardées
          </p>
      </div>
    <div class="event-details">
        <div class="event-image">
          <img src="../images/events/<?=$evenement['image']?>" alt="Image de l'événement">
        </div>
        <div class="event-info">
          <h1><?=$evenement['nom']?></h1>
          <p><?=$evenement['description']?></p>
          <button>S'inscrire</button>
          <button>Recuperer les inscrits</button>
          <button>Inscrire des joueurs</button>
        </div>
      </div>

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
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><img src="" alt="Avatar joueur 1"></td>
                <td>John</td>
                <td>10</td>
              </tr>
              <tr>
                <td><img src="./images/P1000050.JPG" alt="Avatar joueur 2"></td>
                <td>Alice</td>
                <td>15</td>
              </tr>
              <tr>
                <td><img src="avatar3.jpg" alt="Avatar joueur 3"></td>
                <td>Michael</td>
                <td>12</td>
              </tr>
              <!-- Ajoutez plus de lignes pour plus de joueurs -->
            </tbody>
          </table>
        </div>
        </div>
     <!--------------------------------------------DEBUT DU FOOTER ------------------------------------------------------------>
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
</body>
</html>