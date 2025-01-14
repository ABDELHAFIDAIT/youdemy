<?php

    require_once __DIR__ .'./../config/db.php';

    class Course {
        private int $id;
        private string $titre;
        private string $description;
        private string $couverture;
        private string $contenu;
        private string $video;
        private string $status;
        private string $date;
        private $database;

        public function __construct() {
            $this->database = Database::getInstance()->getConnection();
        }

        // GETTERS
        public function getId():int{
            return $this->id;
        }
        public function getTitre():string{
            return $this->titre;
        }
        public function getDescription():string{
            return $this->description;
        }
        public function getContenu():string{
            return $this->contenu;
        }
        public function getVideo():string{
            return $this->video;
        }
        public function getCouvertur():string{
            return $this->couverture;
        }
        public function getStatus():string{
            return $this->status;
        }
        public function getDate():string{
            return $this->date;
        }

        // SETTERS
        public function setTitre($titre):void{
            $this->titre = $titre;
        }
        public function setDescription($description):void{
            $this->description = $description;
        }
        public function setContenu($contenu):void{
            $this->contenu = $contenu;
        }
        public function setVideo($video):void{
            $this->video = $video;
        }
        public function setCouverture($couverture):void{
            $this->couverture = $couverture;
        }
        public function setStatus($status):void{
            $this->status = $status;
        }
        public function setDate($date):void{
            $this->date = $date;
        }

        
    }