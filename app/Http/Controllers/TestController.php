<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function getIndex(Request $req){
        return view('Common.default-dashboard', compact('elements'));
    }
}
