<form method="POST" action="index.php?page=<?php echo $_GET['page'].$action; ?>">
    <label for="libelle">Nom du Projet</label><br>
    <input type="text" name="libelle" id="libelle" required><br>
    <input type="submit" name="create" value=" <?php echo $submit ?> ">
</form>
<?php if (isset($message)) {
    echo '<div>'.$message.'</div>';
}