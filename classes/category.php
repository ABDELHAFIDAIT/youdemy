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


        // GET ALL CATEGORIES
        public function allCategories() {
            try {
                $query = "SELECT id_categorie, nom_categorie, description 
                        FROM categories 
                        ORDER BY id_categorie ASC";

                $stmt = $this->database->prepare($query);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la récupération des catégories : " . $e->getMessage());
            }
        }

        
        // GET CATEGORY BY ID
        public function getCategory($id) {
            try {
                $query = "SELECT id_categorie, nom_categorie, description 
                        FROM categories 
                        WHERE id_categorie = :id";

                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la récupération de la catégorie : " . $e->getMessage());
            }
        }

        
        // ADD CATEGORY
        public function addCategory($nom_categorie, $description) {
            try {
                $query = "INSERT INTO categories (nom_categorie, description) 
                        VALUES (:nom_categorie, :description)";

                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':nom_categorie', $nom_categorie, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
            }
        }


        // DELETE CATEGORY
        public function deleteCategory($id_categorie) {
            try {
                $query = "DELETE FROM categories WHERE id_categorie = :id";

                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':id', $id_categorie, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
            }
        }

    }