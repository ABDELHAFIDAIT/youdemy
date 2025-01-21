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
        

    }

?>