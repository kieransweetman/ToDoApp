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
</form>
<?php if (isset($_POST['pseudo'])) {
    echo '<div>'.$message1.'</div>';
}

endif ;
?>
<h2>Utilisateurs affectés au projet</h2>
<?php
foreach($users as $user){
    echo $user->getPseudo().'<a href="">Désaffecter</a><br>';
}
?>