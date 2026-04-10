<?php
require 'connexion.php';
/* Ajouter une tâche */
if($_SERVER["REQUEST_METHOD"] === "POST") { /* Vérifie si le formulaire a été soumis */
    $titre = $_POST['titre']; /* Récupère les données du formulaire */
    $description = $_POST['description'];
    $statut = $_POST['statut'];
    $priorite = $_POST['priorite'];
    $date_limite = $_POST['date_limite'];
    $date_creation = date('Y-m-d');
    $sql = "INSERT INTO taches (titre, description, statut, priorite, date_limite, date_creation) VALUES (?, ?, ?, ?, ?, ?)"; /* Prépare la requête SQL pour insérer une nouvelle tâche */
    $stmt = $pdo->prepare($sql); /* Prépare la requête pour éviter les injections SQL */
    $stmt->execute([$titre, $description, $statut, $priorite, $date_limite, $date_creation]); /* Exécute la requête avec les données du formulaire */
}

$taches = $pdo->query("SELECT * FROM taches ORDER BY priorite DESC"); /* Récupérer les tâches triées par priorité */
?>

<script> /* Validation du formulaire */ 
function verifierFormulaire() {
    var titre = document.getElementById('titre').value; /* Récupère la valeur du champ titre */
    if(titre === '') {
        alert('Le titre est obligatoire');
        return false;
    }
    return true;
}
/* Filtrer les tâches par statut */
function filtrer(statut) {
    var lignes = document.querySelectorAll('.tache');
    lignes.forEach(function(ligne) { /* Parcourt chaque ligne de tâche et affiche ou masque en fonction du statut sélectionné */
        if(statut === 'toutes' || ligne.dataset.statut === statut) { /* Affiche toutes les tâches ou celles qui correspondent au statut sélectionné */
            ligne.style.display = ''; /* Affiche la ligne */
        } else {
            ligne.style.display = 'none'; /* Masque la ligne */
        }
    });
}
</script>
<!-- Affiche  formulaire et la liste des tâches -->
<h1>Gestion des tâches</h1>

<h2>Ajouter une tâche</h2>
<form method="post" onsubmit="return verifierFormulaire()">
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
<!-- Affiche la liste des tâches avec des boutons pour filtrer par statut -->
<h2>Liste des tâches</h2>
<button onclick="filtrer('toutes')">Toutes</button>
<button onclick="filtrer('a_faire')">À faire</button>
<button onclick="filtrer('termine')">Terminées</button>

<table border="1">
    <tr> <!-- Affiche les en-têtes du tableau pour les tâches --><
        <th>Titre</th>
        <th>Description</th>
        <th>Statut</th>
        <th>Priorité</th>
        <th>Date limite</th>
    </tr> 
    <?php foreach($taches as $t): ?> <!-- Affiche chaque tâche dans un tableau -->
    <tr class="tache" data-statut="<?= $t['statut'] ?>"> <!-- Ajoute une classe et un attribut pour le filtrage -->
        <td><?= htmlspecialchars($t['titre']) ?></td> <!-- Utilise htmlspecialchars pour éviter les problèmes de sécurité liés à l'affichage de données utilisateur -->
        <td><?= htmlspecialchars($t['description']) ?></td> <!-- Utilise htmlspecialchars pour éviter les problèmes de sécurité liés à l'affichage de données utilisateur -->
        <td><?= $t['statut'] ?></td>
        <td><?= $t['priorite'] ?></td>
        <td><?= $t['date_limite'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>