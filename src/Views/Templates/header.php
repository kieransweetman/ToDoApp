<header>

<!-- Définit le titre en haut de la page -->
    <h2><?php echo $TitrePage; ?></h2>

    <nav>
<!-- Barre de anvigation qui s'affiche à toutes les pages -->
        <a href='index.php'>Accueil</a>
        <?php if ($connected) : ?> 
            <a href='index.php?page=afficheprojets'>Mes projets</a>
            <a href='index.php?page=affichetaches'>Mes tâches</a>
            <a href='index.php?page=CreateUpdateCompte&update=<?php echo $_SESSION['id'] ?>'>Mon compte </a>
            <a href='index.php?page=index&session=0'>Déconnexion</a>
        <?php endif ?>
    </nav><br>

</header>