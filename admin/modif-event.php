<?php 
   include 'partials/header.php'
   ?>

<div class="container">
    <div class="header">
      <h2>Modification de l'Evenement (Admin)</h2>
    </div>
    <div class="alert__message-succes">
        <p>
            Modifications sauvgardées
        </p>
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
        <button type="submit">Sauvegarder</button>
      </form>
      <button class="quit-button">Quitter</button>
    </div>
  </div>
  <?php
  include 'partials/footer.php';
  ?>