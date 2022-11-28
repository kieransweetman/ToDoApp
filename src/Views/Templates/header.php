<header>


    <h2><?php echo $TitrePage; ?></h2>

    <nav>

        <a href='index.php'>Accueil</a>
        <?php if ($connected) : ?>
            <a href='index.php?page=afficheprojets'>Mes projets</a>
            <a href='index.php?page=affichetaches'>Mes taches</a>
            <a href='index.php?page=CreateUpdateCompte'>Mon compte </a>
            <a href='index.php?page=index&session=0'>Déconnexion</a>
        <?php endif ?>
    </nav>

</header>