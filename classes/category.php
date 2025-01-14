<?php

    include_once __DIR__ .'./../config/db.php';

    class Categorie{
        private int $id;
        private string $name;
        private string $description;
        private string $date;
        private $database;

        public function __construct(){
            $this->database = Database::getInstance()->getConnection();
        }


        // GETTERS
        public function getId(): int{
            return $this->id;
        }
        public function getName(): string{
            return $this->name;
        }
        public function getDescription(): string{
            return $this->description;
        }
        public function getDate(): string{
            return $this->date;
        }


        // SETTERS
        public function setName(string $name){
            $this->name = $name;
        }
        public function setDescription(string $description){
            $this->description = $description;
        }
        public function setDate(string $date){
            $this->date = $date;
        }

    }