<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Services;
use App\Models\Stylists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Appointments::with(['user', 'services', 'stylists'])->get();
        $user = User::all();
        $services = Services::all();
        $stylists = Stylists::all();

        $statusChange = ['canceled', 'completed', 'confirmed'];

        return view('admin.reports.index', compact('reports', 'statusChange'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:canceled,completed,confirmed'
        ]);
        
        $reports = Appointments::find($request->id);
        $reports->status = $request->status;
        $reports->save();

        return redirect()->back()
                        ->with('success', 'Status Change Success');
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => ['required', 'string', 'max:255']
        ]);

        $keyword = $request->keyword;

        $reports = Appointments::with(['user', 'services', 'stylists'])
                            ->whereHas('user', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');
                            })
                            ->orWhereHas('services', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');
                            })
                            ->orWhereHas('stylists', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');
                            })
                            ->paginate(3);

        $statusChange = ['canceled', 'completed', 'confirmed'];

        return view('admin.reports.search', compact('reports', 'keyword', 'statusChange'));
    }
}
