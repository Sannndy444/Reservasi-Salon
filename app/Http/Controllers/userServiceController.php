<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    public function index()
    {
        $services = Services::all();

        return view('user.services.index', compact('services'));
    }

    public function show($service)
    {
        $services = Services::findOrFail($service);

        return view('user.services.show', compact('services'));
    }
}
