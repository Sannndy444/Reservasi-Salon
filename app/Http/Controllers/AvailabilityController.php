<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use App\Models\Stylists;

class AvailabilityController extends Controller
{
    public function index ()
    {
        $availability = Availability::with('stylists')->get();

        return view('user.appointment.index');
    }
}
