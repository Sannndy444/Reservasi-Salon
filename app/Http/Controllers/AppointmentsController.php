<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Services;
use App\Models\Stylists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function create(Request $request)
    {
        $services = Services::all();
        $userAppointment = Appointments::where('user_id', Auth::id())->get();

        $stylists = [];
        if ($request->has('service')) {
            $stylists = Stylists::where('services_id', $request->service)->get();
        }

        // Kirim data ke view
        return view('user.appointment.index', compact('services', 'stylists', 'userAppointment' ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service' => 'required|exists:services,id',
            'stylist' => 'required|exists:stylists,id',
            'appointment_date' => 'required|date|after:now',
            'appointment_time' => 'required|date_format:H:i',
        ],[
            'appointment_date.after' => 'Tanggal yang di inputkan tidak valid.'
        ]);

        if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->route('user.appointment.index')
                                ->withErrors($validator)
                                ->withInput();
            }

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
