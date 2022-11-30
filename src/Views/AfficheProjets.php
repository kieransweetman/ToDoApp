<?php
echo "<a href='index.php?page=" . $_GET['page'] . "&insert=projet'>Créer un nouveau projet</a>";
echo '<h2>Liste de mes projets</h2>';

//Boucle sur les affectations
foreach ($affectations as $affectation) {
    //Boucle pour afficher les projets
    foreach ($projets as $projet) {
        //Condition pour afficher seulement les projets pour lesquels l'utilisateur courant est administrateur
        if ($_SESSION['id'] === $affectation->getId_users() && $affectation->getId_projets() === $projet->getId() && $affectation->getAdmin() === true) {
            echo $projet->getLibelle();
            echo "<a href='index.php?page=" . $_GET['page'] . '&update=' . $projet->getId() . "'>Modifier</a> ";
            echo "<a href='index.php?page=" . $_GET['page'] . '&delete=' . $projet->getId() . "'>Supprimer</a> ";
            echo "<a href='index.php?page=CreateUpdateTache"  . '&insert=tache/' . $projet->getId() . "'>Ajouter une tâche</a><br>";
            //Apparition du bouton en cas de suppression
            if (isset($_GET['delete']) && $_GET['delete'] == $projet->getId()) {
                echo "Êtes-vous certain(e) de vouloir effectuer la suppression? Le projet et toutes les tâches qui lui sont reliées seront supprimées";
                echo "<form method='POST'><input type='submit' name='oui' value ='Oui''><input type='submit' name='non' value ='Non''></form>";
            }
            //Boucle pour afficher les tâches
            foreach ($taches as $tache) {
                //Condition pour afficher les tâches reliées au projet en cours
                if ($tache->id_projets === $projet->getId()) {
                    echo $tache->getTitre() . ' ';
                    echo $tache->getPriorite() . ' ';
                    echo $tache->getStatut() . ' ';
                    //Boucle pour afficher les users
                    foreach ($users as $user) {
                        //Condition pour afficher l'utilisateur relié à la tâche en cours
                        if ($tache->id_users === $user->getId()) {
                            echo $user->getPseudo();
                        }
                    }
                    echo "<a href='index.php?page=CreateUpdateTache"  . '&update=' . $tache->getId() . "'>Modifier</a> ";
                    echo "<a href='index.php?page=CreateUpdateTache"  . '&delete=' . $tache->getId() . "'>Supprimer</a> ";

                    echo '<br>';
                }
            }
            echo '<br>';
        }
    }
}
