<?php 

namespace app\controllers;
use app\facades\Auth;

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