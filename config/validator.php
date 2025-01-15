<?php

class Validator {

    
    public static function required($value, $fieldName) {
        if (empty($value)) {
            throw new Exception("$fieldName est requis.");
        }
    }

    
    public static function minLength($value, $minLength, $fieldName) {
        if (strlen($value) < $minLength) {
            throw new Exception("$fieldName doit contenir au moins $minLength caractères.");
        }
    }

    
    public static function maxLength($value, $maxLength, $fieldName) {
        if (strlen($value) > $maxLength) {
            throw new Exception("$fieldName doit contenir au maximum $maxLength caractères.");
        }
    }

    
    public static function validatePassword($password) {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        if (!preg_match($pattern, $password)) {
            throw new Exception("Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.");
        }
    }

    
    public static function validateEmail($email): bool {
        $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($pattern, $email)) {
            return false;
        }else{
            return true;
        }
    }
}


?>