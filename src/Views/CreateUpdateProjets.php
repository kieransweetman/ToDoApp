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
<?php if (isset($_POST['addUser'])) {
    echo '<div>'.$message1.'</div>';
}?>

<?php if (isset($_GET['insertuser'])) :?>
<h2>Créer un nouvel utilisateur</h2>
<form method='POST' action=''>
        <input type='text' name='pseudo' placeholder='Nouveau pseudo'><br> <br>
        <input type='email' name='mail' placeholder='Nouveau mail'><br> <br>
        <input type='submit' name='submit' value="Créer utilisateur">
    </form>

<p><?php echo (isset($message2)) ? $message2 : '';?>  </p>

<p><?php echo (isset($pseudo)) ? "L'identifiant de l'utilisateur est $pseudo" : ''; ?>  </p>
<p><?php echo (isset($pwd)) ? "Le mot de passe à communiquer à l'utilisateur est $pwd" : ''; ?>  </p>
<?php  endif ;?>


<h2>Utilisateurs affectés au projet</h2>
<?php

foreach($users as $user){
    echo $user->getPseudo()."<a href='index.php?page=" . $_GET['page'] .'&update='.$_GET['update']."&deleteuser=".$user->getPseudo()."'>Désaffecter</a><br>";
    if(isset($_GET['deleteuser']) && $_GET['deleteuser'] === $user->getPseudo()){
        echo "Êtes-vous certain(e) de vouloir effectuer la désaffectation? Si une tâche lui été affecté, elle n'aura plus d'utilisateur affecté";
        echo "<form method='POST'><input type='submit' name='oui' value ='Oui''><input type='submit' name='non' value ='Non''></form>";
    }
}
endif ;
?>