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
        private string $niveau;
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


        // GET ALL COURSES WITH CATEGORY NAME AND TEACHER FULL NAME
        public function allCourses(){
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
                            ORDER BY
                                Co.date_publication DESC, Co.id_course ASC";

                $stmt = $this->database->prepare($query);
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
        
    }