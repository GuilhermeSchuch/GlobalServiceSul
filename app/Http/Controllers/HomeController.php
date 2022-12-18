<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function index(){
        if(!\Session::get('user')){
            return redirect('auth')->with("error", "Você precisa estar logado!");
        }

        $navbar = "home";

        return view("home", ["navbar"=>$navbar]);
    }
}
