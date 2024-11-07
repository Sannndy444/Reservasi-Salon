<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stylists;

class AvailabilityController extends Controller
{
    public function index ()
    {
        $availability = Stylists::with()
    }

    public function storeAvailability (Request $request)
    {

    }
}
