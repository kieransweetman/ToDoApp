<?php
echo "<a href='index.php?page=" .
    $_GET['page'] .
    "&insert=projet'>Créer un nouveau projet</a><br>";
echo '<h2>Liste de mes projets</h2>';
foreach($affectations as $affectation){
    //Boucle pour afficher les projets
    foreach ($projets as $projet) {
        if($_SESSION['id'] === $affectation->getId_users() && $affectation->getId_projets() === $projet->getId() && $affectation->getAdmin() == 1){
            echo $projet->getLibelle();
            echo "<a href='index.php?page=" .
                $_GET['page'] .
                '&update=' .
                $projet->getId() .
                "'>Modifier</a>";
            echo "<a href='index.php?page=" .
                $_GET['page'] .
                '&delete=' .
                $projet->getId() .
                "'>Supprimer</a> ";
            echo "<a href='index.php?page=" .
                $_GET['page'] .
                '&insert=tache' .
                $projet->getId() .
                "'>Ajouter une tâche</a><br>";
            //Boucle pour afficher les tâches
            foreach ($taches as $tache) {
                if ($tache->id_projets === $projet->getId()) {
                    echo $tache->getTitre() . ' ';
                    echo $tache->getPriorite() . ' ';
                    echo $tache->getStatut() . ' ';
                    //Boucle pour afficher les users
                    foreach ($users as $user) {
                        if ($tache->id_users === $user->getId()) {
                            echo $user->getPseudo();
                        }
                    }
                    echo "<a href='index.php?page=" .
                        $_GET['page'] .
                        '&update=tache' .
                        $tache->getId() .
                        "'>Modifier</a> ";
                    echo "<a href='index.php?page=" .
                        $_GET['page'] .
                        '&delete=tache' .
                        $tache->getId() .
                        "'>Supprimer</a> ";
                    echo '<br>';
                }
            }
            echo '<br>';
        }
    }
}