<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;

class HomeController extends Controller
{
    function Index(){
        return view('index');
    }
    function Admin(){
        return view('admin');
    }
}
