<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Services;
use App\Models\Stylists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointment = Appointments::with(['user', 'services', 'stylists'])->get();

        return view('user.appointment.index', compact('appointment'));
    }

    public function create()
    {
        $user = User::all();
        $service = Services::all();
        $stylist = Stylists::all();
        return view('user.appointment.create', compact('user','services', 'stylists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|exist:services,id',
            'stylist' => 'required|exist:stylists,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        Appointments::create([
            'user_id' => auth()->id(),
            'service' => $request->service,
            'stylist' => $request->stylist,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);

        return redirect()->route('user.appointment.index')
                        ->with('success', 'Appointment berhasil dibuat');
    }
}
