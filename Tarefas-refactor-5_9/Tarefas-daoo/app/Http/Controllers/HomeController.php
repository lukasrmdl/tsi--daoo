<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        echo "HomeController: Olá Mundo!!";
        //dd($this);//dieAndDump;
    }
}
