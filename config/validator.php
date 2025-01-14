<?php

class Validator {

    
    public static function required($value, $fieldName) {
        if (empty($value)) {
            echo "<script>alert('$fieldName est requis.');</script>";
        }
    }

    
    public static function minLength($value, $minLength, $fieldName) {
        if (strlen($value) < $minLength) {
            echo "<script>alert('$fieldName doit contenir au moins $minLength caractères.');</script>";
        }
    }

    
    public static function maxLength($value, $maxLength, $fieldName) {
        if (strlen($value) > $maxLength) {
            echo "<script>alert('$fieldName doit contenir au maximum $maxLength caractères.');</script>";
        }
    }

    
    public static function validatePassword($password, $fieldName) {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        if (!preg_match($pattern, $password)) {
            echo "<script>alert('$fieldName doit contenir au moins une lettre majuscule, une minuscule, un chiffre et un caractère spécial.');</script>";
        }
    }

    
    public static function validateEmail($email, $fieldName) {
        $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($pattern, $email)) {
            echo "<script>alert('$fieldName est invalide.');</script>";
        }
    }
}

?>