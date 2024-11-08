<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    public function index()
    {
        $suggestion = Suggestion::with(['user'])->get();

        return view('admin.suggestions.index', compact('suggestion'));
    }
}
