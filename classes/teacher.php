<?php

    require_once __DIR__ .'./user.php';

    class Teacher extends User {

        public function __construct($nom,$prenom,$telephone,$email,$password,$role,$status,$photo) {
            parent::__construct( $nom, $prenom, $telephone, $email, $password, $role, $status, $photo);
        }

    }

?>