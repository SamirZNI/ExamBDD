<?php
require 'connexion.php';
/* Ce fichier contient la logique de base pour gérer les tâches :
- Ajouter une tâche : Lorsque le formulaire est soumis, les données sont insérées dans la base de données.
- Supprimer une tâche : Lorsque le lien de suppression est cliqué, la tâche correspondante est supprimée de la base de données.
- Afficher les tâches : Les tâches sont récupérées de la base de données et affichées dans un tableau. */
if($_SERVER["REQUEST_METHOD"] === "POST") { /*  Vérifie si le formulaire a été soumis en utilisant la méthode POST. Si c'est le cas, les données du formulaire sont traitées pour ajouter une nouvelle tâche à la base de données. */
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $statut = $_POST['statut'];
    $priorite = $_POST['priorite'];
    $date_limite = $_POST['date_limite'];
    $date_creation = date('Y-m-d');
    $sql = "INSERT INTO taches (titre, description, statut, priorite, date_limite, date_creation) VALUES (?, ?, ?, ?, ?, ?)"; /* Prépare une requête SQL pour insérer une nouvelle tâche dans la table "taches" de la base de données. Les points d'interrogation (?) sont des placeholders pour les valeurs qui seront passées lors de l'exécution de la requête. */
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $description, $statut, $priorite, $date_limite, $date_creation]); /* Prépare et exécute une requête SQL pour insérer une nouvelle tâche dans la table "taches" de la base de données. Les valeurs sont passées en tant que paramètres pour éviter les injections SQL. */
}

if(isset($_GET['supprimer'])) { /* Vérifie si le paramètre "supprimer" est présent dans l'URL. Si c'est le cas, cela signifie que l'utilisateur a cliqué sur le lien de suppression pour une tâche spécifique. Le code récupère l'ID de la tâche à supprimer et exécute une requête SQL pour supprimer cette tâche de la base de données. */
    $id = $_GET['supprimer'];
    $stmt = $pdo->prepare("DELETE FROM taches WHERE id = ?");
    $stmt->execute([$id]);
}

$taches = $pdo->query("SELECT * FROM taches ORDER BY priorite DESC");
?>