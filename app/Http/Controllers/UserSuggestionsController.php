<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSuggestionsController extends Controller
{
    public function index()
    {
        return view('user.suggestions.index');
    }
}
