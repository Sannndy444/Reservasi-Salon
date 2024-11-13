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
        $userAppointment = Appointments::where('user_id', Auth::id())->get();
        $user = User::all();
        $services = Services::all();
        $stylists = Stylists::all();

        return view('user.appointment.index', compact('appointment', 'userAppointment','stylists', 'services'));
    }

    public function create()
    {
        return view('user.appointment.index',compact('stylists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|exists:services,id',
            'stylist' => 'required|exists:stylists,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        Appointments::create([
            'user_id' => auth()->id(),
            'services_id' => $request->service,
            'stylist_id' => $request->stylist,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);



        return redirect()->route('user.appointment.index')
            ->with('success', 'Appointment berhasil dibuat');
    }
}
