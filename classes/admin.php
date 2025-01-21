<?php

    // require_once __DIR__ .'./displayCourse.interface.php';
    require_once __DIR__ .'./user.php';

    class Admin extends User{

        public function __construct($id,$nom,$prenom,$telephone,$email,$password,$role,$status,$photo){
            parent::__construct($nom,$prenom,$telephone,$email,$password,$role,$status,$photo);
            $this->id = $id;
        }

        // APPROUVE COURSE
        public function approuveCourse($id_course) {
            try {
                $query = "UPDATE courses 
                          SET statut_cours = 'Approuvé' 
                          WHERE id_course = :id_course";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(':id_course', $id_course, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'approbation du cours : " . $e->getMessage());
            }
        }


        //REFUSE COURSE
        public function refuseCourse($id_course) {
            try {
                $query = "UPDATE courses 
                          SET statut_cours = 'Refusé' 
                          WHERE id_course = :id_course";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(':id_course', $id_course, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'approbation du cours : " . $e->getMessage());
            }
        }


        // SHOW USERS
        public function showUsers($role) {
            try {
                $query = "SELECT * FROM users 
                          WHERE id_role = :role 
                          ORDER BY date_inscription DESC";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(':role', $role, PDO::PARAM_INT);
        
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
            }
        }
        
        // ACTIVATE USER
        public function activateUser($id_user) {
            try {
                $query = "UPDATE users 
                          SET statut = 'Actif' 
                          WHERE id_user = :id_user";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        
                return $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'activation de l'utilisateur : " . $e->getMessage());
            }
        }

        // SUSPEND USER
        public function suspendUser($id_user) {
            try {
                $query = "UPDATE users 
                          SET statut = 'Bloqué' 
                          WHERE id_user = :id_user";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        
                return $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la suspension de l'utilisateur : " . $e->getMessage());
            }
        }

        // DELETE USER
        public function deleteUser($id_user) {
            try {
                $query = "DELETE FROM users 
                          WHERE id_user = :id_user";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        
                return $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            }
        }
    }

?>