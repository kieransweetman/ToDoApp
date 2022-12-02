<main>
<?php
//affichage des messages d'erreurs
if (isset($message)) {
    echo '<div class="errorMsg">' . $message . '</div>';
}
?>


<?php if (!$connected) : ?>
    <!-- formulaire pour compléter son profil -->
    <form class="formCompte" method='POST' action='index.php?page=<?php echo $_GET['page']; ?>&insert=1'>
        <input type='text' name='pseudo' placeholder='Votre pseudo' value="<?php echo (isset($pseudo)) ? $pseudo : ''; ?>"><br> <br>
        <input type='email' name='mail' placeholder='Votre mail' value="<?php echo (isset($mail)) ? $mail : ''; ?>"><br> <br>
        <input type='password' name='pwd' placeholder='Votre mot de passe'><br> <br>
        <input type='password' name='confirmpwd' placeholder='Confirmez votre mot de passe'><br> <br>
        <input type='submit' name='submit' value="Enregistrer">
    </form>

<?php endif ?>

<?php if ($connected) : ?>
    <!-- formulaire pour modifier son profil -->
    <form class="formCompte" method='POST' action='index.php?page=<?php echo $_GET['page']; ?>&update=<?php echo $_SESSION['id'] ?>'>
        <input type='text' name='pseudo' placeholder='Votre pseudo' value="<?php echo (isset($pseudo)) ? $pseudo : ''; ?>"><br> <br>
        <input type='email' name='mail' placeholder='Votre mail' value="<?php echo (isset($mail)) ? $mail : ''; ?>"><br> <br>
        <input type='password' name='pwd' placeholder='Nouveau mot de passe'> <br> <br>
        <input type='password' name='confirmpwd' placeholder='Confirmez votre mot de passe'><br> <br>
        <input type='submit' name='create' value="Modifier">
    </form>

<?php endif ?>
</main>