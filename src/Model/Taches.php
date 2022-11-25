<?php

namespace Digi\Todoapp\Model;

class Taches {
    private $id;
    private string $titre;
    private string $priorite;
    private string $statut;
    private string $description;
    private Users $users;
}