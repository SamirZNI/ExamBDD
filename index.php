<?php
require 'connexion.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $statut = $_POST['statut'];
    $priorite = $_POST['priorite'];
    $date_limite = $_POST['date_limite'];
    $date_creation = date('Y-m-d');
    $sql = "INSERT INTO taches (titre, description, statut, priorite, date_limite, date_creation) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $description, $statut, $priorite, $date_limite, $date_creation]);
}

$taches = $pdo->query("SELECT * FROM taches ORDER BY priorite DESC");
?>

<h1>Tâches</h1>

<h2>Ajouter une tâche</h2>
<form method="post">
    Titre : <input type="text" name="titre"><br>
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
<table border="1">
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Statut</th>
        <th>Priorité</th>
        <th>Date limite</th>
    </tr>
    <?php foreach($taches as $t): ?>
    <tr>
        <td><?= htmlspecialchars($t['titre']) ?></td>
        <td><?= htmlspecialchars($t['description']) ?></td>
        <td><?= $t['statut'] ?></td>
        <td><?= $t['priorite'] ?></td>
        <td><?= $t['date_limite'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>