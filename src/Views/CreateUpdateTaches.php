<?php if (isset($_GET['update']) || isset($_GET['delete'])) { ?>



    <main>
        <form action="" method="POST">

            <h3><?php echo $projet->getLibelle(); ?></h3>

            <div>
                <label for="titre">Nom de la tâche:</label>
                <input type="text" id="titre" name="titre" value=<?php echo "'" .
                                                                        $tache->getTitre() .
                                                                        "'"; ?>>
            </div>

            <div>
                <label for="priorite">Priorité:</label>
                <input type="text" id="priorite" name="priorite" value=<?php echo "'" .
                                                                            $tache->getPriorite() .
                                                                            "'"; ?>>
            </div>

            <div>
                <label for="statut">Statut:</label>
                <select name="statut" id="statut" style="height:50%; margin: 16px 0px;">



                    <option value="">Statut</option>
                    <option value="Non Débuté" <?php if (
                                                    $tache->getStatut() === 'Non Débuté'
                                                ) :
                                                    echo 'selected';
                                                endif; ?>>Non débuté </option>
                    <option value="En Cours" <?php if (
                                                    $tache->getStatut() === 'En cours'
                                                ) :
                                                    echo 'selected';
                                                endif; ?>>En cours</option>

                    <option value="Terminé" <?php if (
                                                $tache->getStatut() === 'Terminé'
                                            ) :
                                                echo 'selected';
                                            endif; ?>>Terminé</option>
                </select>
            </div>
            <div>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value=<?php echo "'" .
                                                                                    $tache->getDescription() .
                                                                                    "'"; ?>>
            </div>
            <div>
                <label for="user">Affectation:</label>
                <select name="id_users" id="user">
                    <?php foreach ($users as $user) { ?>
                        <option value=<?php echo "'" .
                                            $user->getId() .
                                            "'"; echo ($user->getId() === $tache->id_users) ? 'selected': "" ;?> > <?php echo $user->getPseudo(); ?></option>
                        
                    <?php } ?>




                </select>
            </div>

            <div style="display:none;">
                <label for="id_projets">projet id:</label>
                <input type="text" value="<?php echo $projet->getId(); ?>" name='id_projets'>
            </div>

            <div>
                <input type="submit" value="valider" name='update' <?php if (
                                                                        isset($_GET['delete'])
                                                                    ) :
                                                                        echo "style='display:none;'";
                                                                    endif; ?>>
            </div>
        </form>

        <?php if (
            isset($_GET['delete']) &&
            $_GET['delete'] == $tache->getId()
        ) {
            echo 'Êtes-vous certain(e) de vouloir effectuer la suppression? Le tache et toutes les données qui lui sont reliées seront supprimées';
            echo "<form method='POST'><input type='submit' name='oui' value ='Oui''><input type='submit' name='non' value ='Non''></form>";
        } ?>
    </main>

<?php }

// Creez nouveau tache

if (isset($_GET['insert'])) { ?>
    <main>
        <form action="" method="POST">

            <h3><?php echo $projet->getLibelle(); ?></h3>
            <div>
                <label for="titre">Nom de la tâche:</label>
                <input type="text" id="titre" name="titre" value=''>
            </div>

            <div>
                <label for="priorite">Priorité:</label>
                <input type="text" id="priorite" name="priorite" value=''>
            </div>

            <div>
                <label for="statut">Statut:</label>
                <select name="statut" id="statut" style="height:50%; margin: 16px 0px;">



                    <option value="">Statut</option>
                    <option value="Non Débuté">Non débuté </option>
                    <option value="En Cours">En cours</option>

                    <option value="Terminé">Terminé</option>
                </select>
            </div>
            <div>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value=''>
            </div>
            <div>
                <label for="user">Affectation:</label>
                <select name="id_users" id="user">
                    <?php foreach ($users as $user) { ?>

                        <option value=<?php echo "'" .
                                            $user->getId() .
                                            "'"; ?>> <?php echo $user->getPseudo(); ?></option>

                    <?php } ?>




                </select>
            </div>

            <div style="display:none;">
                <label for="id_projets">projet id:</label>
                <input type="text" value="<?php echo $projet->getId(); ?>" name='id_projets'>
            </div>

            <div>
                <input type="submit" value="valider" name='create'>
            </div>
        </form>
    </main>


<?php }
?>