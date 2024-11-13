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
        $reports = appointments::with(['user', 'services', 'stylists'])->get();

        $user = User::all();
        $services = Services::all();
        $stylists = Stylists::all();

        return view('admin.reports.index', compact('reports'));
    }
}
