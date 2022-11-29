<?php
//Test de validation pour éviter les doublons de libellé en modification
    private function isValid(){
        $return ='';
        $projets = Projets::getByAttribute('libelle',$_POST['libelle']);
        if(isset($_GET['insert'])){
            if(count($projets)>0){
                $return = "Le libellé de ce projet existe déjà";
            }
            return $return;
        }
        if(isset($_GET['update'])){
            $affectation = Affectation::getByAttribute('id_projets', $_GET['update']);
            if(count($projets)>0 && $_SESSION['id'] !== $affectation[0]->getId_users()){
                $return = "Le libellé de ce projet existe déjà";
            }
            return $return;
        }
    

     //Test de validation pour éviter les doublons de libellé en création
    private function isValidCreate(){
        $return ='';
        $projets = Projets::getByAttribute('libelle',$_POST['libelle']);
        if(count($projets)>0){
            $return = "Le libellé de ce projet existe déjà";
        }
        return $return;
    }

    //Test de validation pour éviter les doublons de libellé en modification
    private function isValidUpdate(){
        $return ='';
        $projets = Projets::getByAttribute('libelle',$_POST['libelle']);
        $affectation = Affectation::getByAttribute('id_projets', $_GET['update']);
        if(count($projets)>0 && $_SESSION['id'] !== $affectation[0]->getId_users()){
            $return = "Le libellé de ce projet existe déjà";
        }
        return $return;
    }