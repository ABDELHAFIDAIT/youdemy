<?php

    require_once __DIR__ .'./../config/db.php';

    class Course {
        private int $id;
        private string | null $titre;
        private string | null $description;
        private string | null $couverture;
        private string | null $contenu;
        private string | null $video;
        private string | null $status;
        private string | null $date;
        private string | null $niveau;
        private $database;

        public function __construct($titre,$description,$couverture,$contenu,$video,$statut,$niveau) {
            $this->titre = $titre;
            $this->description = $description;
            $this->couverture = $couverture;
            $this->contenu = $contenu;
            $this->video = $video;
            $this->status = $statut;
            $this->date = $statut;
            $this->niveau = $niveau;
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
        public function getContenu():string | NULL{
            return $this->contenu;
        }
        public function getVideo():string{
            return $this->video;
        }
        public function getCouverture():string{
            return $this->couverture;
        }
        public function getStatus():string{
            return $this->status;
        }
        public function getDate():string{
            return $this->date;
        }
        public function getNiveau():string{
            return $this->niveau;
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
        public function setNiveau($niveau):void{
            $this->niveau = $niveau;
        }


        // GET ALL COURSES WITH CATEGORY NAME AND TEACHER FULL NAME
        public function allCourses($status){
            try{
                $query = "SELECT Co.id_course,
                                Co.titre,
                                Co.description,
                                Co.couverture,
                                Co.contenu,
                                Co.video,
                                Co.niveau,
                                Co.date_publication,
                                Co.statut_cours,
                                Ca.nom_categorie AS categorie,
                                CONCAT(U.prenom, ' ', U.nom) AS enseignant,
                                U.photo
                            FROM 
                                courses Co
                            JOIN 
                                categories Ca ON Co.id_categorie = Ca.id_categorie
                            JOIN 
                                users U ON Co.id_teacher = U.id_user
                            WHERE
                                Co.statut_cours = :statut
                            ORDER BY
                                Co.date_publication DESC, Co.id_course ASC";

                $stmt = $this->database->prepare($query);
                $stmt->bindValue(":statut", $status, PDO::PARAM_STR);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                throw new Exception("Erreur lors de la Récupération des Cours : ". $e->getMessage());
            }
        }

        // GET ALL COURSES WITH CATEGORY NAME AND TEACHER FULL NAME WITH PAGINATION
        public function getCourses($status, $limit, $depart){
            try{
                $query = "SELECT Co.id_course,
                                Co.titre,
                                Co.description,
                                Co.couverture,
                                Co.contenu,
                                Co.video,
                                Co.niveau,
                                Co.date_publication,
                                Co.statut_cours,
                                Ca.nom_categorie AS categorie,
                                U.prenom,
                                U.nom,
                                U.photo
                            FROM 
                                courses Co
                            JOIN 
                                categories Ca ON Co.id_categorie = Ca.id_categorie
                            JOIN 
                                users U ON Co.id_teacher = U.id_user
                            WHERE
                                Co.statut_cours = :statut
                            ORDER BY
                                Co.date_publication DESC, Co.id_course ASC
                            LIMIT :limit OFFSET :offset";

                $stmt = $this->database->prepare($query);
                $stmt->bindValue(":statut", $status, PDO::PARAM_STR);
                $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
                $stmt->bindValue(":offset", $depart, PDO::PARAM_INT);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }else{
                    return false;
                }
            }catch(PDOException $e){
                throw new Exception("Erreur lors de la récupération des cours : " . $e->getMessage());
            }
        }


        // GET COURSE BY ID
        public function getCourse($id){
            try{
                $query = "SELECT Co.id_course,
                                Co.titre,
                                Co.description,
                                Co.couverture,
                                Co.contenu,
                                Co.video,
                                Co.niveau,
                                Co.date_publication,
                                Co.statut_cours,
                                Ca.nom_categorie,
                                U.prenom,
                                U.nom,
                                U.photo
                            FROM 
                                courses Co
                            JOIN 
                                categories Ca ON Co.id_categorie = Ca.id_categorie
                            JOIN 
                                users U ON Co.id_teacher = U.id_user
                            WHERE
                                Co.id_course = :id";
                $stmt = $this->database->prepare($query);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $result;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                throw new Exception("Erreur lors de la Récupération du Cours : ". $e->getMessage());
            }
        }

        
        // GET COURSES OF A SPECIFIC TEACHER
        public function allTeacherCourses($id){
            try{
                $query = "SELECT Co.id_course,
                                Co.titre,
                                Co.description,
                                Co.couverture,
                                Co.contenu,
                                Co.video,
                                Co.niveau,
                                Co.date_publication,
                                Co.statut_cours,
                                Ca.nom_categorie AS categorie,
                                CONCAT(U.prenom, ' ', U.nom) AS enseignant
                            FROM 
                                courses Co
                            JOIN 
                                categories Ca ON Co.id_categorie = Ca.id_categorie
                            JOIN 
                                users U ON Co.id_teacher = U.id_user
                            WHERE
                                Co.id_teacher = :id
                            ORDER BY
                                Co.date_publication DESC, Co.id_course ASC";
                $stmt = $this->database->prepare($query);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                throw new Exception("Erreur lors de la Récupération des Cours de l'Enseignant : ". $e->getMessage());
            }
        }


        // ADD COURSE
        public function addCourse($titre,$description,$contenu,$video,$couverture,$niveau,$id_categorie,$id_teacher){
            try{
                $query = "INSERT INTO courses 
                                (titre, description, contenu, video, couverture, niveau, id_categorie, id_teacher) 
                         VALUES 
                                (:titre, :description, :contenu, :video, :couverture, :niveau,:id_categorie, :id_teacher)";

                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
                $stmt->bindParam(':video', $video, PDO::PARAM_STR);
                $stmt->bindParam(':couverture', $couverture, PDO::PARAM_STR);
                $stmt->bindParam(':niveau', $niveau, PDO::PARAM_STR);
                $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
                $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);

                if($stmt->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                throw new Exception('Erreur Lors de l\'Ajout du Cours : '. $e->getMessage());
            }
        }


        // DELETE COURSE
        public function deleteCourse($id_course){
            try{
                $query = 'DELETE FROM courses WHERE id_course = :id';

                $stmt = $this->database->prepare($query);

                $stmt->bindParam(':id', $id_course, PDO::PARAM_INT);

                if( $stmt->execute() ){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                throw new Exception('Erreur Lors de La Suppression du Cours : '. $e->getMessage());
            }
        }


        // COUNT ALL COURSES
        public function countAllCourses(){
            try{
                $query = 'SELECT COUNT(*) AS nbr_courses FROM courses';
                $stmt = $this->database->prepare($query);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }else{
                    return 0;
                }
            }catch(PDOException $e){
                throw new Exception('Erreur Lors de la Récupération du Nombre des Cours : '. $e->getMessage());
            }
        }

        // COUNT COURSES OF A SPECIFIC TEACHER
        public function countTeacherCourses($id_teacher){
            try{
                $query = 'SELECT COUNT(*) AS nbr_courses FROM courses WHERE id_teacher = :id';
                $stmt = $this->database->prepare($query);
                $stmt->bindParam(':id', $id_teacher, PDO::PARAM_INT);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }else{
                    return 0;
                }
            }catch(PDOException $e){
                throw new Exception('Erreur Lors de la Récupération du Nombre des Cours : '. $e->getMessage());
            }
        }

        // LAST 3 COURSES PUBLISHED BY A SPECIFIC TEACHER
        public function lastThreeCourses($id_teacher) {
            try {
                $query = "SELECT 
                              Co.id_course,
                              Co.titre,
                              Co.description,
                              Co.couverture,
                              Co.contenu,
                              Co.video,
                              Co.niveau,
                              Co.date_publication,
                              Ca.nom_categorie AS categorie
                          FROM 
                              courses Co
                          JOIN 
                              categories Ca ON Co.id_categorie = Ca.id_categorie
                          WHERE 
                              Co.id_teacher = :id_teacher
                          ORDER BY 
                              Co.date_publication DESC
                          LIMIT 3";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindParam(":id_teacher", $id_teacher, PDO::PARAM_INT);
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la récupération des 3 derniers cours publiés par l'enseignant : " . $e->getMessage());
            }
        }


        // COUNT COURSES BY STATUS
        public function countCourse($status){
            try{
                $query = "SELECT COUNT(*) AS total FROM courses WHERE statut_cours = :statut";
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(":statut", $status, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['total'];
            }catch(PDOException $e){
                throw new Exception("Erreur lors du comptage des cours : " . $e->getMessage());
            }
        }



        //
        public function getUnsubscribedCourses($id_etudiant, $status, $limit, $offset) {
            try {
                $query = "SELECT 
                            Co.id_course,
                            Co.titre,
                            Co.description,
                            Co.couverture,
                            Co.contenu,
                            Co.video,
                            Co.niveau,
                            Co.date_publication,
                            Co.statut_cours,
                            Ca.nom_categorie AS categorie,
                            U.prenom, 
                            U.nom,
                            U.photo
                        FROM 
                            courses Co
                        JOIN 
                            categories Ca ON Co.id_categorie = Ca.id_categorie
                        JOIN 
                            users U ON Co.id_teacher = U.id_user
                        WHERE 
                            Co.statut_cours = :statut
                            AND Co.id_course NOT IN (
                                SELECT id_course 
                                FROM enrollments 
                                WHERE id_student = :id_etudiant
                            )
                        ORDER BY 
                            Co.date_publication DESC, Co.id_course ASC
                        LIMIT :limit OFFSET :offset";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(":statut", $status, PDO::PARAM_STR);
                $stmt->bindValue(":id_etudiant", $id_etudiant, PDO::PARAM_INT);
                $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
                $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la récupération des cours : " . $e->getMessage());
            }
        }


        //
        public function countUnsubscribedCourses($id_etudiant, $status) {
            try {
                $query = "SELECT COUNT(*) AS total 
                          FROM courses Co
                          WHERE Co.statut_cours = :statut
                            AND Co.id_course NOT IN (
                                SELECT id_course 
                                FROM enrollments 
                                WHERE id_student = :id_etudiant
                            )";
        
                $stmt = $this->database->prepare($query);
                $stmt->bindValue(":statut", $status, PDO::PARAM_STR);
                $stmt->bindValue(":id_etudiant", $id_etudiant, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['total'];
            } catch (PDOException $e) {
                throw new Exception("Erreur lors du comptage des cours non inscrits : " . $e->getMessage());
            }
        }
        
        
        
        
    }