<div>
    <?php

    ?>
    <form action="" method="POST">

        <h3><?php echo   $projet->getLibelle(); ?></h3>
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
            <label for="description">Description:</label>
            <input type="text" id="description" name="description">
        </div>
        <div>
            <label for="user">Affectation:</label>
            <select name="id_users" id="user">
                <?php
                foreach ($users as $user) {

                ?>

                    <option value=<?php echo "'" . $user->getId() . "'"; ?>> <?php echo $user->getPseudo(); ?></option>

                <?php
                }
                ?>




            </select>
        </div>

        <div style="display:none;">
            <label for="id_projets">projet id:</label>
            <input type="text" value="<?php echo $projet_id ?>" name='id_projets'>
        </div>

        <div>
            <input type="submit" value="valider" name='create'>
        </div>
    </form>
</div>