<?php

namespace app\controllers;

class TestController extends Controller{

    public function index(){
        $this->view('test');
    }
}