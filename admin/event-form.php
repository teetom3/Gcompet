<?php 
   include 'partials/header.php'
   ?>

<div class="container">
    <div class="header">
      <h2>Créer un Événement (Admin)</h2>
    </div>
    <div class="form-container">
      <form>
        <div class="form-group">
          <label for="nom">Nom de l'Événement :</label>
          <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
          <label for="categorie">Catégorie de l'Événement :</label>
          <select id="categorie" name="categorie">
            <option value="competition">Compétition</option>
            <option value="cours">Cours</option>
            <option value="autre">Autre</option>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Description de l'Événement :</label>
          <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label for="date">Date de l'Événement :</label>
          <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
          <label for="places">Nombre de Places Disponibles :</label>
          <input type="number" id="places" name="places" required>
        </div>
        <div class="form-group">
          <label for="image">Image de l'Événement (facultatif) :</label>
          <input type="file" id="image" name="image">
        </div>
        <button type="submit">Créer l'Événement</button>
      </form>
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

    </footer>
</body>
</html>