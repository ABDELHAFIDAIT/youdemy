<?php

    require_once __DIR__ .'./displayCourse.interface.php';
    require_once __DIR__ .'./user.php';

    class Admin extends User implements DisplayCourse{

        // public function __construct(){
        //     parent::__construct();
        // }

        public function displayCourses($param){
            
        }

    }

?>