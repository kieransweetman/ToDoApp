<form method="POST" action="index.php?page=<?php echo $_GET['page'].$action?>">
    <label for="libelle">Nom du Projet</label><br>
    <input type="text" name="libelle" id="libelle" value="<?php echo (isset($libelle)) ? $libelle : ''; ?>" required><br>
    <input type="submit" name="create" value=" <?php echo $submit ?> ">
</form>
<?php if (isset($message)) {
    echo '<div>'.$message.'</div>';
}

if(isset($_GET['update'])) : 
?>

<form method='POST' action="">
    <label for="">Utilisateurs</label><br>
    <input type="text" name="pseudo"><br>
    <input type="submit" name="addUser" value="Ajouter utilisateur">
</form><br>
<?php if (isset($_POST['pseudo'])) {
    echo '<div>'.$message1.'</div>';
}?>

<?php if (isset($_GET['adduser'])) :?>
<h2>Créer un nouvel utilisateur</h2>
<form method='POST' action=''>
        <input type='text' name='pseudo' placeholder='Nouveau pseudo' value="<?php echo (isset($pseudo)) ? $pseudo : ''; ?>"><br> <br>
        <input type='email' name='mail' placeholder='Nouveau mail' value="<?php echo (isset($mail)) ? $mail : ''; ?>"><br> <br>
        <input type='submit' name='submit' value="Créer utilisateur">
    </form>
<?php  endif ;?>


<h2>Utilisateurs affectés au projet</h2>
<?php

foreach($users as $user){
    echo $user->getPseudo()."<a href='index.php?page=" . $_GET['page'] .'&update='.$_GET['update']."&deleteuser=".$user->getPseudo()."'>Désaffecter</a><br>";
}
endif ;
?>