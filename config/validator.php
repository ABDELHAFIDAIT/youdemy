<?php

class Validator {

    
    public static function required($value, $fieldName) {
        if (empty($value)) {
            return false;
        }else{
            return true;
        }
    }

    
    public static function minLength($value, $minLength, $fieldName) {
        if (strlen($value) < $minLength) {
            return false;
        }
        return true;
    }

    
    public static function maxLength($value, $maxLength, $fieldName) {
        if (strlen($value) > $maxLength) {
            return false;
        }
        return true;
    }

    
    public static function validatePassword($password) {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        if (!preg_match($pattern, $password)) {
            return false;
        }
        return true;
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