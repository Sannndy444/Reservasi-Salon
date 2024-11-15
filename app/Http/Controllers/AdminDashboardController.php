<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Services;
use App\Models\Stylists;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index ()
    {
        $user = User::all();
        $service = Services::all();
        $stylist = Stylists::all();
        $appointment = Appointments::all();

        return view('admin.dashboard.index', compact('user', 'service', 'stylist', 'appointment'));
    }
}
