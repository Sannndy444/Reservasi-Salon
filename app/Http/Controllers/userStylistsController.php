<?php

namespace App\Http\Controllers;

use App\Models\stylists;
use Illuminate\Http\Request;

class userStylistsController extends Controller
{
    public function index()
    {
        return view('admin.stylists.index', compact('stylists'));
    }
}
