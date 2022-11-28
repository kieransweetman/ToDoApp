<?php
if (isset($message)) {
    echo '<div>'.$message.'</div>';
}
?>

<form method='POST' action='index.php?page=<?php echo $_GET['page']; ?>&insert=1'>
    <input type='text' name='pseudo' placeholder='Votre pseudo' value="<?php echo (isset($pseudo)) ? $pseudo : ''; ?>"><br> <br>
    <input type='email' name='mail' placeholder='Votre mail'><br> <br>
    <input type='password' name='pwd' placeholder='Votre mot de passe'><br> <br>
    <input type='password' name='confirmpwd' placeholder='Confirmez votre mot de passe'><br> <br>
    <input type='submit' name='submit' value="Enregistrer">
</form>