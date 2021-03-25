<?php

namespace app\controllers;

class TestController extends Controller{

    public function index(){
        $this->view('testResendToken');
    }

    public function index2(){
        $this->view('testVerifyToken');
    }
}