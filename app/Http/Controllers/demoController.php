<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demo;

class demoController extends Controller
{
    public function demo(){
        $var = Demo::all();
        return view('home',compact('var'));
    }
}
