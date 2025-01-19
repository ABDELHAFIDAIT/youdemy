<?php

    require_once __DIR__ .'./user.php';

    class Teacher extends User {

        public function __construct($id,$nom,$prenom,$telephone,$email,$password,$role,$status,$photo) {
            parent::__construct( $nom, $prenom, $telephone, $email, $password, $role, $status, $photo);
            $this->id = $id;
        }

        // COUNT MY COURSES
        public function countCourses($id_teacher,$status){
            try {
                $query = "SELECT COUNT(*) AS course_count 
                          FROM courses 
                          WHERE id_teacher = :id_teacher AND statut_cours = :status";
                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
                $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['course_count'];
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la Récupération du Nombre de Cours: " . $e->getMessage());
            }
        }

        // COUNT ENROLLED STUDENTS IN MY COURSES
        public function countEnrolledStudents($id_teacher){
            try {
                $query = "SELECT COUNT(DISTINCT enrollments.id_student) AS total_students
                        FROM enrollments
                        JOIN courses ON enrollments.id_course = courses.id_course
                        WHERE courses.id_teacher = :id_teacher";
                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['total_students'];
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la Récupération du Nombre des Etudiants: " . $e->getMessage());
            }
        }

        // COUNT COURSES PER CATEGORY
        public function countCoursesPerCategory($id_teacher){
            try {
                $query = "SELECT categories.nom_categorie, COUNT(courses.id_course) AS course_count
                        FROM courses
                        INNER JOIN categories ON courses.id_categorie = categories.id_categorie
                        WHERE courses.id_teacher = :id_teacher
                        GROUP BY categories.nom_categorie";
                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la Récupération du Nombre des Cours Par catégorie: " . $e->getMessage());
            }
        }

    }

?>