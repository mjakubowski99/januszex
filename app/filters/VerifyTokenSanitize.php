<?php 

namespace app\filters;

class VerifyTokenSanitize{

    public function escapeSpecialChars($userData){
        return filter_var($userData, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    public function sanitize($userData){
        return $this->escapeSpecialChars($userData);
    }
}