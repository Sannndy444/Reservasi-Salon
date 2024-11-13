<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSuggestionsController extends Controller
{
    public function index()
    {
        $suggest = Suggestion::with('user')->get();
        $user = User::all();
        $userSuggest = Suggestion::where('user_id', Auth::id())->get();

        return view('user.suggestions.index', compact('suggest', 'userSuggest', 'user'));
    }

    public function create()
    {
        return view('user.suggestions.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'suggest' => 'required|string|max:5000',
        ]);
                
        Suggestion::create([
            'suggest' => $request->suggest,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('user.suggestions.index')
                        ->with('success', 'Saran Berhasil Di Berikan.');
    }
}
