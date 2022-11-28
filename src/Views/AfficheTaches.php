<?php
// echo "<pre>";
// var_dump($projets);
// echo "</pre>"
?>


<h2>Liste de mes taches</h2>
<main>
    <?php
    foreach ($taches as $tache) {
    ?>
        <hr style="width: 100vw; color:black;">
        <div class="project_1">
            <h3><?php foreach ($projets as $projet) {
                    if ($projet->getId() === $tache->id_projets) {
                        echo $projet->getLibelle();
                    }
                }; ?></h3>
            <form action="" method=" POST" style="display:flex; flex-direction:column; gap:16px;">

                <div style="display:flex; gap:16px;">

                    <p><?php echo $tache->getTitre(); ?></p>
                    <p>priorit <?php echo $tache->getPriorite(); ?></p>
                    <label for="statut" style="margin: 16px 0px;"></label>
                    <select name="statut" id="statut" style="height:50%; margin: 16px 0px;">
                        <option value="" <?php if ($tache->getStatut() === null) : ?> disabled selected <? endif; ?>>Statut</option>
                        <option value="" <?php if ($tache->getStatut() === "Non Débuté") : ?> selected <? endif; ?>>Non débuté </option>
                        <option value="dog" <?php if ($tache->getStatut() === "En Cours") : ?> selected <? endif; ?>>En cours</option>
                        <option value="cat" <?php if ($tache->getStatut() === "Terminé") : ?> selected <? endif; ?>>Terminé</option>
                    </select>

                </div>


                <p>
                    Description:
                    <?php echo $tache->getDescription(); ?>
                </p>



                <input type="submit" value="Valider">

            </form>

        </div>

    <?php
    }
    ?>

</main>