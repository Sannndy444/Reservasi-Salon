<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    public function index()
    {
        return view('admin.suggestions.index');
    }
}
