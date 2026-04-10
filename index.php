<?php require 'config/conf.php'; ?>
<!-- Ce fichier est la page principale de l'application de gestion de tâches. Il inclut le fichier de configuration "conf.php" qui contient la logique pour gérer les tâches (ajout, suppression, affichage). La page affiche un formulaire pour ajouter une nouvelle tâche, ainsi qu'une liste des tâches existantes avec des options pour filtrer et supprimer les tâches. -->
<link rel="stylesheet" href="css/style.css">
<script src="js/script.js"></script>

<h1>Tâches</h1>

<h2>Ajouter une tâche</h2>
<form method="post" onsubmit="return verifierFormulaire()"> <!-- Affiche un formulaire pour ajouter une nouvelle tâche. Le formulaire utilise la méthode POST pour envoyer les données au serveur. La fonction JavaScript "verifierFormulaire" est appelée lors de la soumission du formulaire pour vérifier que le champ du titre n'est pas vide avant d'envoyer les données au serveur. -->
    Titre : <input type="text" name="titre" id="titre"><br>
    Description : <input type="text" name="description"><br>
    Statut :
    <select name="statut">
        <option value="a_faire">À faire</option>
        <option value="en_cours">En cours</option>
        <option value="termine">Terminé</option>
    </select><br>
    Priorité :
    <select name="priorite">
        <option value="haute">Haute</option>
        <option value="normale">Normale</option>
        <option value="basse">Basse</option>
    </select><br>
    Date limite : <input type="date" name="date_limite"><br>
    <button type="submit">Ajouter</button>
</form>

<h2>Liste des tâches</h2>
<button onclick="filtrer('toutes')">Toutes</button> <!-- Affiche un bouton pour filtrer les tâches affichées. Lorsque l'utilisateur clique sur ce bouton, la fonction JavaScript "filtrer" est appelée avec le paramètre "toutes", ce qui affiche toutes les tâches sans filtrage. -->
<button onclick="filtrer('a_faire')">À faire</button>
<button onclick="filtrer('termine')">Terminées</button>

<table border="1">
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Statut</th>
        <th>Priorité</th>
        <th>Date limite</th>
        <th>Action</th>
    </tr>
    <?php foreach($taches as $t): ?>
    <tr class="tache" data-statut="<?= $t['statut'] ?>"> <!-- Affiche une ligne pour chaque tâche dans le tableau. La classe "tache" est utilisée pour appliquer des styles CSS et la data-attribute "data-statut" est utilisée pour stocker le statut de la tâche, ce qui permet de filtrer les tâches en fonction de leur statut. -->
        <td><?= htmlspecialchars($t['titre']) ?></td>
        <td><?= htmlspecialchars($t['description']) ?></td>
        <td><?= $t['statut'] ?></td>
        <td><?= $t['priorite'] ?></td> <!-- Affiche les détails de chaque tâche dans une ligne du tableau. Les données sont échappées avec htmlspecialchars pour éviter les problèmes de sécurité liés à l'injection de code HTML. -->
        <td><?= $t['date_limite'] ?></td> <!-- Affiche les détails de chaque tâche dans une ligne du tableau. Les données sont échappées avec htmlspecialchars pour éviter les problèmes de sécurité liés à l'injection de code HTML. -->
        <td><a href="index.php?supprimer=<?= $t['id'] ?>">Supprimer</a></td> <!-- Affiche un lien de suppression pour chaque tâche. Lorsque l'utilisateur clique sur ce lien, il envoie une requête GET avec le paramètre "supprimer" contenant l'ID de la tâche à supprimer. Le code dans conf.php gère cette requête pour supprimer la tâche correspondante de la base de données. -->
    </tr>
    <?php endforeach; ?>
</table>