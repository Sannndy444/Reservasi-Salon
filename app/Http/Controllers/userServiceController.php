<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userServiceController extends Controller
{
    public function index()
    {
        return view('user.services.index');
    }
}
