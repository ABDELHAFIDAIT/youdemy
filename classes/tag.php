<?php

    require_once __DIR__ . './../config/db.php';
    class Tag {
        private $id;
        private $nom;
        private array $courses = [];

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


        // ALL TAGS
        public function allTags(){
            try {
                $sql = "SELECT T.id_tag, T.nom_tag, COUNT(CT.id_course) AS course_count 
                        FROM tags T LEFT JOIN courses_tags CT ON T.id_tag = CT.id_tag
                        GROUP BY T.id_tag, T.nom_tag ";
                $stmt = $this->database->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreurs Lors de La récupération des Tags : ". $e->getMessage());
            }
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

        // COURESES'S TAGS
        public function showCourseTags($id){
            try {
                $sql = "SELECT nom_tag
                        FROM tags T 
                            JOIN courses_tags CT ON T.id_tag = CT.id_tag
                        WHERE CT.id_course = :id";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreurs Lors de La récupération des Tags : ". $e->getMessage());
            }
        }


        // ASSIGN TAG
        public function assignTag($tag,$course){ 
            try {
                $sql = "INSERT INTO courses_tags(id_tag , id_course) VALUES (:id_tag , :id_course)";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":id_tag", $tag, PDO::PARAM_INT);
                $stmt->bindParam(":id_course", $course, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'insertion dans l'Assignement des Tags au cours : ". $e->getMessage());
            }
        }
        
    }