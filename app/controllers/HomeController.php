<?php 

class HomeController extends Controller{

    public function index(){
        $this->view('home', ['data' => 'data']);
    }
    
    public function store(){
        
    }
}