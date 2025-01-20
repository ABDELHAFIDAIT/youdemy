<?php

    require_once __DIR__ .'./displayCourse.interface.php';
    require_once __DIR__ .'./user.php';

    class Admin extends User implements DisplayCourse{

        public function __construct($id,$nom,$prenom,$telephone,$email,$password,$role,$status,$photo){
            parent::__construct($nom,$prenom,$telephone,$email,$password,$role,$status,$photo);
            $this->id = $id;
        }

        public function displayCourses($param){
            
        }

    }

?>