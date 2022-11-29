<form method="POST" action="index.php?page=<?php echo $_GET['page'].$action; ?>">
    <label for="libelle">Nom du Projet</label><br>
    <input type="text" name="libelle" id="libelle" value="<?php echo (isset($libelle)) ? $libelle : ''; ?>" required><br>
    <input type="submit" name="create" value=" <?php echo $submit ?> ">
</form>
<?php if (isset($message)) {
    echo '<div>'.$message.'</div>';
}
?>

<form method='POST' action="">
    <label for="">Utilisateurs</label><br>
    <input type="text" name="pseudo"><br>
    <input type="submit" name="addUser" value="Ajouter utilisateur">
</form>
<?php if (isset($_POST['pseudo'])) {
    echo '<div>'.$message1.'</div>';
}
?>