<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Model\Taches;
use Digi\Todoapp\Model\Users;
use Digi\Todoapp\Core\Security;
use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Core\Validate;
use Digi\Todoapp\Model\Affectation;
use Digi\Todoapp\Model\Projets;

class TachesController
{
    public function __construct()
    {
        if ($_GET['page'] === 'CreateUpdateTache') {

            if (isset($_GET['insert'])) {
                $data = explode('/', $_GET['insert']);
                $projet = $data[1];
                $this->createTache($projet);
            }
            if (isset($_POST['create'])) {
                if(($message = $this->verifyCreateTask()) === ''){
                    Taches::create();
                }
            }

            if (isset($_GET['update'])) {
                $idTache = $_GET['update'];
                $this->updateTache($idTache);

                if (isset($_POST['update'])) {
                    // 1. cherchez tout les taches d'un projet
                    // 2. les ordonnee par priorite
                    // 3. un algo avec le priorite change, qui boucle sur la liste des taches, et change la priorite
                    $tache = Taches::getById($idTache);
                    $projetId = $tache[0]->id_projets;
                    
                    if(($message =$this->verifyUpdateTask()) === ''){
                        Taches::updateById();
                    }

                    Taches::updateById();

                    $prioriteValide = $this->prioriteCheck($tache[0]->getPriorite(),$_POST["priorite"], $projetId, $tache[0]->getId());
                    foreach($prioriteValide as $tache){
                        $this->changePriorite($tache);
                    }
                    
                   
                    
                    
                    echo "<meta http-equiv='refresh' content='0;URL=index.php?page=afficheprojets'>";
                    return;
                }
            }

            if (isset($_GET['delete'])) {
                $idTache = $_GET['delete'];
                $this->delTache($idTache);
            }
        }

        if ($_GET['page'] === 'affichetaches') {
            if (isset($_POST['submit'])) {
                if(($message =$this->verifyUpdateTask()) === ''){
                    $this->changeStatut();
                }
                $this->AffichesTaches();
                return;
            } else {
                $this->AffichesTaches();
                return;
            }
        }
    }

    private function prioriteCheck($currentPriorite = null, $newPriorite = null, $projet_id, $tacheId)
    {

        //definir les tableau pour check et faire les changements
        $temp = [];
        $return = [];
        $taches = Taches::getByAttribute('id_projets', $projet_id);

        $count = 0;
        foreach ($taches as $tache) {
             $temp += [$tache->getId()=>$tache->getPriorite()];
             
        }
        asort($temp, SORT_NUMERIC );

        foreach($temp as $id => $priorite){
            $return += [$count => [$id=>$priorite]];
            $count++;
        }

        $toCompare = null;

        // currentPriorite => newPriorite
        foreach($return as $index=>$tache){
            foreach($tache as $id=>$priorite){
                if($tacheId === $id){
                    $toCompare = $index;
                    $tache[$id] = $newPriorite;
                    $return[$index] = [$id=>$tache[$id]];
                }

            }
            
        }

        $lastValue = array_values($return[count($return) - 1])[0];
       
        // boucle pour decaler le tableau par 1
        foreach($return as $index=>$tache){
            if($index === $toCompare){
                continue;
            }
            // si index plus petit que priorite a change
            if($index > $toCompare){
            
                // echo array_values($tache)[0];
                foreach($tache as $id =>$priorite){
                    
                   
                    // si newPriorite est plus grand que la dernier valeur, newPriotie devient le dernier valuer
                    if($newPriorite > $lastValue){
                        $newPriorite = $lastValue; 
                        $return[$toCompare] = [$tacheId=>$newPriorite];
                    }

                    if($newPriorite <= 0){
                        $newPriorite = 1;
                        $return[$toCompare] = [$tacheId=>$newPriorite];
                    }

                    // decale tableau par -1
                    if($newPriorite >= $priorite && $newPriorite <=$lastValue ){

                        $priorite--;
                        $return[$index] = [$id=>$priorite];
                    }
                }
            }

             // si index plus grande que priorite a change
            if($index < $toCompare){
                
                foreach($tache as $id=>$priorite){
                    
                    // Si newpriorite <= 0, newPriorite devient 1
                    if($newPriorite <= 0){
                        $newPriorite = 1;
                        $return[$toCompare] = [$tacheId=>$newPriorite];
                    }
                    
                    if($newPriorite > count($return)){
                        
                        $newPriorite = count($return);; 
                        $return[$toCompare] = [$tacheId=>$newPriorite];
                    }
                   
                   // decale tableau par +1
                   if($newPriorite <= $priorite){
                    $priorite++;
                    $return[$index] = [$id=>$priorite];
                   }
                }
            }
        }
        return $return;
    }

    private function changePriorite($taches = null)
    {
        foreach ($taches as $id => $priorite) {
            Taches::updateAttributeById('priorite', $priorite, $id);
        }
    }

    private function delTache($idTache = null)
    {
        $this->updateTache($idTache);

        if (isset($_POST['oui'])) {
            Taches::deleteById($_GET['delete']);
            header('refresh:0; url=index.php?page=afficheprojets');
        }
        if (isset($_POST['non'])) {
            header('location: index.php?page=afficheprojets');
        }
    }

    private function changeStatut()
    {

        if (isset($_POST['statut'])) {
            $selected = $_POST['statut'];

            $selected = explode('/', $selected);

            Taches::updateAttributeById('statut', $selected[0], $selected[1]);
        }
    }

    /**
     * Modifier et mettre à jour un tache
     *
     * @param  $idTache
     * @return void
     */
    private function updateTache($idTache = null)
    {
        $view = new Views('CreateUpdateTaches', 'Update Tache');
        $idTache = intVal($idTache);

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }

        $tache = Taches::getByAttribute('id', $idTache);
        $projet = Projets::getByAttribute('id', $tache[0]->id_projets);
        $users = Affectation::getByAttribute('id_projets', $tache[0]->id_projets);


        // genere un tableau avec tout les users affecté sur un projet 
        $return = [];
        foreach ($users as $user) {
            
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }
        // variables

        $view->setVar('tache', $tache[0]);
        $view->setVar('TitrePage', 'Update un tache');
        $view->setVar('users', $return);
        $view->setVar('projet', $projet[0]);
        $view->render();
    }

    private function createTache($projet_id = null)
    {
        $view = new Views('CreateUpdateTaches', 'Creez un Tache');

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }

        $projet = Projets::getByAttribute('id', $projet_id);
        $users = Affectation::getByAttribute('id_projets', $projet_id);

        //  genere un tableau avec tout les users affecté sur un projet 
        $return = [];
        foreach ($users as $user) {
            
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }
        // variables

        $view->setVar('TitrePage', 'Creez un Tache');
        $view->setVar('projet_id', $projet_id);
        $view->setVar('users', $return);
        $view->setVar('projet', $projet[0]);
        $view->render();
    }

    private function AffichesTaches()
    {
        $view = new Views('AfficheTaches', 'Mes Taches');

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }

        $user = $_SESSION['id'];
        $projets = Projets::getAllOrderBy('id');
        $taches = Taches::getAllOrderBy('priorite');
        $affectations = Affectation::getByAttribute('id_users', $user);

        // variables
        $view->setVar('TitrePage', 'Mes Taches');
        $view->setVar('user', $user);
        $view->setVar('affectations', $affectations);
        $view->setVar('taches', $taches);
        $view->setVar('projets', $projets);
        $view->render();
    }

    // fonction pour vérifier les entrées de formulaire sur une création de tache
    private function verifyCreateTask()
    {
        $return = '';
        $return .= Validate::validateTask($_POST['titre'], 'Le nom doit être renseigné <br>');
        $return .= Validate::validateTask($_POST['priorite'], 'La priorité doit être renseigné <br>');
        $return .= Validate::validateTask($_POST['statut'], 'Le statut doit être renseigné <br>');
        $return .= Validate::validateTask($_POST['description'], 'La Description doit être renseigné <br>');
        return $return;
    }

    // fonction pour vérifier l'entré status de formulaire sur une modification de tache
    private function verifyUpdateTask()
    {
        $return = '';
        $return .= Validate::validateTask($_POST['statut'], 'Le statut doit être renseigné <br>');
        return $return;
    }
}
