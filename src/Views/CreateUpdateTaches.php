<?php 

?>

<html>
    <head>
        <title>Create/Update tache</title>
    </head>



    <h1>Create/ Update tache</h1>

    <div>
        <h2>Titre du projet</h2>
        <div>
            <label for="nomTache">Nom de la tâche:</label>
            <input type="text" id="nomTache" name="nomTache"> 
        </div>

        <div>
            <label for="priorite">Priorité:</label>
            <input type="text" id="priorite" name="priorite">
        </div>

        <div>
            <label for="statut">Statut:</label>
                <select name="statut" id="statut" style="height:50%; margin: 16px 0px;">
                    <option value="" <?php if ($tache->getStatut() === null) : ?> disabled selected <? endif; ?>>Statut</option>
                    <option value="" <?php if ($tache->getStatut() === "Non Débuté") : ?> selected <? endif; ?>>Non débuté </option>
                    <option value="" <?php if ($tache->getStatut() === "En Cours") : ?> selected <? endif; ?>>En cours</option>
                    <option value="" <?php if ($tache->getStatut() === "Terminé") : ?> selected <? endif; ?>>Terminé</option>
                </select>
        </div>

        <div>
            <label for="affectation">Affectation:</label>
            <select name="affectation" id="afectation">
                    <option>

                    </option>
                </select>
        </div>

        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description">
        </div>

        <div>
            <input type="button">
        </div>
    </div>
</html>