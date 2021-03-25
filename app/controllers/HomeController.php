<?php 

namespace app\controllers;

class HomeController extends Controller{

    public function index(){
        if( !Auth::isLogged() ){
			echo \json_encode([ 'message' => 'Zaloguj sie']);
			die();
        }
        else{
            echo \json_encode([ 'message' => 'Valid' ]);
        }
    }
    
}