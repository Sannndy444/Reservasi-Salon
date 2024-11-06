<?php

namespace App\Http\Controllers;

use App\Http\Models\Appointments;
use App\Http\Models\Services;
use App\Http\Models\Stylists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointment = Appointments::with(['services', 'stylists']);

        return view('user.appointment.index');
    }

    public function create()
    {
        $services = Services::all();
        $stylists = Stylists::all();

        return view('user.appointment.create', compact('services', 'stylists'));
    }

    public function store()
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'stylist_id' => 'required|exists:stylists.id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'stylist_id' => $request->stylist_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
            'total_price' => Services::find($request->service_id)->price,
        ]);

        return redirect()->route('user.appointment.indec')
                        ->with('success', 'Appointment Berhasil Di Buat.');
    }
}
