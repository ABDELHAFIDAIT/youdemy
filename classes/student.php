<?php

    require_once __DIR__ .'./user.php';

    class Student extends User {


        public function __construct($nom,$prenom,$telephone,$email,$password,$role,$status,$photo) {
            parent::__construct( $nom, $prenom, $telephone, $email, $password, $role, $status, $photo);
        }

        // SUBSCRIBE TO A COURSE
        public function subscribeToCourse($student,$course){
            try{
                $sql = 'INSERT INTO enrollments(id_course,id_student)
                        VALUES (:course,:student)';
                $query = $this->database->prepare($sql);
                $query->bindParam(':student', $student, PDO::PARAM_INT);
                $query->bindParam(':course', $course, PDO::PARAM_INT);
                if($query->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                throw new Exception('Erreur lors de l\'Inscription à ce cours : ' .$e->getMessage());
            }
        }

    }

?>