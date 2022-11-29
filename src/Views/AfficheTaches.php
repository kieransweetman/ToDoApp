<?php
// echo "<pre>";
// var_dump($projets);
// echo "</pre>"
?>


<h2>Liste de mes taches</h2>
<main>
    <?php

    foreach ($projs as $proj) {
        foreach ($projets as $projet) {

            if ($user === $proj->getId_user() && $proj->getId_projets() === $projet->getId()) {
                foreach ($taches as $tache) {
                    if ($tache->id_projets === $projet->getId() && $tache->id_users === $user) :

    ?>
                        <hr style="width: 100vw; color:black;">
                        <section class="projet_<?php echo $projet->getId(); ?>">
                            <h3><?php
                                echo $projet->getLibelle();
                                ?></h3>


                            <div class="tache_<?php echo $tache->getId() ?>">
                                <form action="" method="POST" style="display:flex; flex-direction:column; gap:16px;">

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
                                        <?php echo $tache->getDescription();
                                        ?>
                                    </p>

                                    <input type="submit" value="Valider" style="width: 3.5  rem;">

                                </form>
                            </div>
                        <?php endif; ?>



                    <?php


                }
                    ?>
                        </section> <?php
                                }
                            }
                        };
                                    ?>

</main>