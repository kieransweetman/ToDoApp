<p>
    <?php
    echo $hello;
    if ($connected) {
        echo ' ' . $_SESSION['pseudo'];
    }
    ?>

</p>


<!-- Rajouter balise de connection  -->


<?php if ($connected != true) : ?>
    <form method='POST' action='index.php'>
        <input name='pseudo' type='text' placeholder='Pseudo'>
        <input name='pwd' type='password' placeholder="Votre mot de passe">
        <input type='submit' name='submit' value='Se connecter'>
        
    </form>
    <a href='index.php?page=CreateUpdateCompte'> Créer un compte</a>
<?php endif; ?>
