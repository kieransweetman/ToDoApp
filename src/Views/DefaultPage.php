<main>
<p class="helloUser">
    <?php
    if ($connected) {
        echo $hello;
        echo ' ' . $_SESSION['pseudo'];
        echo '<span> !</span>';
    }
    ?>
</p>

<?php if ($connected != true) : ?>
    <div class="formLogin">
        <p><?php echo isset($message) ? $message : "";  ?></p>
        <form method='POST' action='index.php'>
            <input name='pseudo' type='text' placeholder='Pseudo'>
            <input name='pwd' type='password' placeholder="Votre mot de passe">
            <input type='submit' name='submit' value='Se connecter'>

        </form>
        <a class="créerCompte" href='index.php?page=CreateUpdateCompte'> Créer un compte</a>
    </div>
<?php endif; ?>
</main>