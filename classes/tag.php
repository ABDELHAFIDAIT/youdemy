<?php

    require_once __DIR__ . './../config/db.php';
    class Tag {
        private $id;
        private $nom;

        private $database;

        public function __construct($nom) {
            $this->nom = $nom;
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


        // ADD TAG
        public function addTag($nom){
            try {
                $sql = "INSERT INTO tags (nom_tag) VALUES (:nom)";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
                if($stmt->execute()){
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'ajout du Tag : " . $e->getMessage());
            }
        }


        // ADD MULTIPLE TAGS
        public function addMultipleTags(array $tags){
            try {
                $sql = "INSERT INTO tags (nom_tag) VALUES (:nom)";
                $stmt = $this->database->prepare($sql);
                foreach($tags as $tag){
                    $stmt->bindParam(":nom", $tag, PDO::PARAM_STR);
                    $stmt->execute();
                }
                return true;
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'ajout du Tag : " . $e->getMessage());
            }
        }


        // DELETE TAG
        public function deleteTag($id){
            try {
                $sql = "DELETE FROM tags WHERE id_tag = :id";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                if($stmt->execute()){
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur Lors de la Sppression du Tag : ". $e->getMessage());
            }
        }


        // UPDATE TAG
        public function updateTag($id,$nom){
            try {
                $sql = "UPDATE tags SET nom_tag = :nom WHERE id_tag = :id";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
                if($stmt->execute()){
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur Lors de la Modification du Tag : ". $e->getMessage());
            }
        }
        
    }