<?php
echo "<a href='index.php?page=".$_GET['page']."&insert=projet'>Créer un nouveau projet</a><br>";
echo "<h2>Liste de mes projets</h2>";
foreach($projets as $projet){
    echo $projet->getLibelle();
    echo "<a href='index.php?page=".$_GET['page']."&delete=".$projet->getId()."'>Supprimer</a> ";
    echo "<a href='index.php?page=".$_GET['page']."&update=".$projet->getId()."'>Modifier</a>";
    echo "<a href='index.php?page=".$_GET['page']."&insert=tache".$projet->getId()."'>Ajouter tâche</a><br>";
    foreach($taches as $tache){
        if($tache->id_projets === $projet->getId()){
            echo $tache->getTitre();
            echo '<br>';
        }
    }
    echo '<br>';
}