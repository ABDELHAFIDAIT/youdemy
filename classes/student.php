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
        
        
        // GET SUBSCRIBED COURSES
        public function subscribedCourses($student) {
            try {
                $sql = 'SELECT 
                            Co.id_course,
                            Co.titre,
                            Co.description,
                            Co.couverture,
                            Co.niveau,
                            Co.contenu,
                            Co.video,
                            Co.statut_cours,
                            Ca.nom_categorie,
                            U.prenom,
                            U.nom,
                            U.photo
                        FROM enrollments E
                        INNER JOIN courses Co ON E.id_course = Co.id_course
                        INNER JOIN categories Ca ON Co.id_categorie = Ca.id_categorie
                        INNER JOIN users U ON Co.id_teacher = U.id_user
                        WHERE E.id_student = :student';
                
                $query = $this->database->prepare($sql);
                $query->bindParam(':student', $student, PDO::PARAM_INT);
                $query->execute();
                
                $courses = $query->fetchAll(PDO::FETCH_ASSOC);
                return $courses;
            } catch (PDOException $e) {
                throw new Exception('Erreur lors de la récupération des cours inscrits : ' . $e->getMessage());
            }
        }
    }

?>