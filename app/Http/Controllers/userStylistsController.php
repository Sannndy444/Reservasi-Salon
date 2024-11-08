<?php

namespace App\Http\Controllers;

use App\Models\Stylists;
use Illuminate\Http\Request;

class UserStylistsController extends Controller
{
    public function index()
    {
        $stylists = Stylists::all();

        return view('user.stylists.index', compact('stylists'));
    }

    public function show($stylist)
    {
        $stylists = Stylists::findOrFail($stylist);

        return view('user.stylists.show', compact('stylists'));
    }
}
