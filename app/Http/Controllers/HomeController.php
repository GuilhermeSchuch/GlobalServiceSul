<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function index(){
        $navbar = "home";
        $bootstrap = "true";

        return view("home", ["navbar"=>$navbar, "bootstrap"=>$bootstrap]);
    }
}
