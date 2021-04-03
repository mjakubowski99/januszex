<?php


namespace app\controllers;

use app\facades\Auth;


class ResetPasswordController extends Controller
{
    public function index(){
        $this->view('resetPassword');
    }

    public function store(){
        
    }
}