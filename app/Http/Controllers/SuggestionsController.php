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

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => ['required', 'string', 'max:255']
        ]);

        $keyword = $request->keyword;

        $suggestion = Suggestion::with(['user'])
                                ->whereHas('user', function ($query) use ($keyword) {
                                    $query->where('name', 'like', '%' . $keyword . '%');
                                })->paginate(3);

        return view('admin.suggestions.search', compact('suggestion'));
    }
}
