<?php

namespace app\resource;

class UserResource{

    public function createHelloMessageForEmail($message, $email){
        $data = [
            'message' => $message,
            'email' => $email,
        ];

        return json_encode($data);
    }
}