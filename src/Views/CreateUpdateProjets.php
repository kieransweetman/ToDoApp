<main>
<form method="POST" class="formProject" action="index.php?page=<?php echo $_GET['page'].$action?>">
    <label for="libelle">Nom du Projet</label><br>
    <input type="text" name="libelle" id="libelle" value="<?php echo (isset($libelle)) ? $libelle : ''; ?>" required><br>
    <input type="submit" name="create" value=" <?php echo $submit ?> ">
</form>
<?php if (isset($message)) {
    echo '<div class="errorMsg">'.$message.'</div>';
}

if(isset($_GET['update'])) : 
?>

<form method='POST' class="formProject" action="">
    <label for="">Utilisateurs</label><br>
    <input type="text" name="pseudo"><br>
    <input type="submit" name="addUser" value="Ajouter utilisateur">
</form><br>
<?php if (isset($_POST['addUser'])) {
    echo '<div class="errorMsg">'.$message1.'</div>';
}?>

<?php if (isset($_GET['insertuser'])) :?>
<h3>Créer un nouvel utilisateur</h3>
<form method='POST' class="formProject" action=''>
        <input type='text' name='pseudo' placeholder='Nouveau pseudo'><br> <br>
        <input type='email' name='mail' placeholder='Nouveau mail'><br> <br>
        <input type='submit' name='submit' value="Créer utilisateur">
    </form>

<p class="validation"><?php echo (isset($message2)) ? $message2 : '';?>  </p>

<p class="validation"><?php echo (isset($pseudo)) ? "L'identifiant de l'utilisateur est <span>$pseudo</span>" : ''; ?>  </p>
<p class="validation"><?php echo (isset($pwd)) ? "Le mot de passe à communiquer à l'utilisateur est <span>$pwd</span>" : ''; ?>  </p>
<?php  endif ;?>


<h3>Utilisateurs affectés au projet</h3>
<?php

foreach($users as $user){
    echo "<p class='listUser'>".$user->getPseudo()."<a href='index.php?page=" . $_GET['page'] .'&update='.$_GET['update']."&deleteuser=".$user->getPseudo()."'>Désaffecter</a></p><br>";
    if(isset($_GET['deleteuser']) && $_GET['deleteuser'] === $user->getPseudo()){
        echo "<p>Êtes-vous certain(e) de vouloir effectuer la désaffectation? Si une ou plusieurs tâches sont en cours chez lui, elle n'aura plus d'utilisateur affecté</p>";
        echo "<form method='POST'><input type='submit' name='oui' value ='Oui''><input type='submit' name='non' value ='Non''></form>";
    }
}
endif ;
?>
</main>