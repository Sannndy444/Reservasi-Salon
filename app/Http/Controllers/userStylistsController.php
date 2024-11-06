<?php

namespace App\Http\Controllers;

use App\Models\stylists;
use Illuminate\Http\Request;

class UserStylistsController extends Controller
{
    public function index()
    {
        $stylists = Stylists::all();

        return view('user.stylists.index', compact('stylists'));
    }

    public function show()
    {
        $stylists = Stylists::findOrFail();

        return view('user.stylists.index', compact('stylists'));
    }
}
