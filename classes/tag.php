<?php

    require_once __DIR__ . './../config/db.php';
    class Tag {
        private $id;
        private $nom;

        private $database;

        public function __construct() {
            $this->database = Database::getInstance()->getConnection();
        }    

        // Getters
        public function getId() {
            return $this->id;
        }
        public function getNom() {
            return $this->nom;
        }

        // Setters
        public function setNom($nom) {
            $this->nom = $nom;
        }


        
    }