<h1>Create/ Update tache</h1>

<div>
    <form action="" method="POST">
        <h2><?php echo $projet_id; ?></h2>
        <div>
            <label for="titre">Nom de la tâche:</label>
            <input type="text" id="titre" name="titre">
        </div>

        <div>
            <label for="priorite">Priorité:</label>
            <input type="text" id="priorite" name="priorite">
        </div>

        <div>
            <label for="statut">Statut:</label>
            <select name="statut" id="statut" style="height:50%; margin: 16px 0px;">
                <option value="" disabled selected>Statut</option>
                <option value="Non Débuté">Non débuté </option>
                <option value="En Cours">En cours</option>
                <option value="Terminé">Terminé</option>
            </select>
        </div>

        <div>
            <label for="user">Affectation:</label>
            <select name="user" id="user">
                <option>
                <option value="Kiki">Kiki</option>

                </option>
            </select>
        </div>

        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description">
        </div>

        <div>
            <input type="submit" value="valider" name='submit'>
        </div>
    </form>
</div>