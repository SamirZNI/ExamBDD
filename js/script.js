/* Ce fichier contient les fonctions JavaScript pour gérer l'interaction avec l'utilisateur dans l'application de gestion de tâches. Il inclut une fonction pour vérifier le formulaire avant de le soumettre, ainsi qu'une fonction pour filtrer les tâches affichées en fonction de leur statut. */
function verifierFormulaire() {
    var titre = document.getElementById('titre').value; /* Récupère la valeur du champ de saisie pour le titre de la tâche. */
    if(titre === '') {
        alert('Le titre est obligatoire');
        return false;
    }
    return true;
}

function filtrer(statut) {
    var lignes = document.querySelectorAll('.tache'); /* Sélectionne tous les éléments avec la classe "tache", qui représentent les lignes du tableau affichant les tâches. */
    lignes.forEach(function(ligne) {
        if(statut === 'toutes' || ligne.dataset.statut === statut) { /* Vérifie si le statut sélectionné est "toutes" ou si le statut de la ligne correspond au statut sélectionné. Si c'est le cas, la ligne est affichée ; sinon, elle est masquée. */
            ligne.style.display = '';
        } else {
            ligne.style.display = 'none';
        }
    });
}