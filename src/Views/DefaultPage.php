<p>
    <?php
    echo $hello;
    if ($connected === true) {
        echo " " . $pseudo;
    } ?>
</p>


<!-- Rajouter balise de connection  -->


<?php


if ($connected != true) :

?>
    <form method='POST' action='index.php'>
        <input name='pseudo' type='text' placeholder='Pseudo'>
        <input name='pwd' type='password' placeholder="Votre mot de passe">
        <input type='submit' name='submit' value='Se connecter'>
    </form>
<?php endif;
