<?php

?>


<h2>Liste de mes taches</h2>
<main>
    <?php

    foreach ($affectations as $affectation) {
        $temp = null;
        $count = 1;
        foreach ($projets as $projet) {

            if ($user === $affectation->getId_user() && $affectation->getId_projets() === $projet->getId()) {

                foreach ($taches as $tache) {
                    if ($tache->id_projets === $projet->getId() && $tache->id_users === $user) { ?>
                        <?php if ($projet->getId() === $temp) { ?>

                            <hr style="width: 100vw; color:black;">
                        <?php $count++;
                        } else {
                        ?>
                            <h3><?php echo " " . $projet->getLibelle(); ?></h3>
                            <hr style="width: 100vw; color:black;">

                        <?php $temp = $projet->getId();
                        }
                        ?>

                        <section class="projet_<?php echo $projet->getId(); ?>">



                            <div class="tache_<?php echo $tache->getId() ?>">
                                <form action="" method="POST" style="display:flex; flex-direction:column; gap:16px;">

                                    <div style="display:flex; gap:16px;">

                                        <p><?php echo "Tache " . $count . " : " . $tache->getTitre(); ?></p>
                                        <p>priorit <?php echo $tache->getPriorite(); ?></p>
                                        <label for="statut" style="margin: 16px 0px;"></label>
                                        <select name="statut" id="statut" style="height:50%; margin: 16px 0px;">
                                            <option value=<?php echo "'Non Débuté/" . $tache->getId() . "'" ?> <?php
                                                                                                                if ($tache->getStatut() === "Non Débuté") : ?> selected <? endif; ?>>Non débuté </option>
                                            <option value=<?php echo "'En Cours/" . $tache->getId() . "'" ?> <?php if ($tache->getStatut() === "En Cours") : ?> selected <? endif; ?>>En cours</option>
                                            <option value=<?php echo "'Terminé/" . $tache->getId() . "'" ?> <?php if ($tache->getStatut() === "Terminé") : ?> selected <? endif; ?>>Terminé</option>
                                        </select>

                                    </div>

                                    <p>
                                        Description:
                                        <?php echo $tache->getDescription();
                                        ?>
                                    </p>

                                    <input type="submit" name='submit' value="valider" style="width: 3.5  rem;">

                                </form>
                            </div>
                        <?php }; ?>



                    <?php


                }
                    ?>
                        </section> <?php
                                }
                            }
                        };
                                    ?>

</main>