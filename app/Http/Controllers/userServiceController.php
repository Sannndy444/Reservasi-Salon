<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class userServiceController extends Controller
{
    public function index()
    {
        return view('users.services.index', compact('stylists'));
    }
}
