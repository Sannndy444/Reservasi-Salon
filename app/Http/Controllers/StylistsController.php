<?php

namespace App\Http\Controllers;

use App\Models\Stylists;
use Illuminate\Http\Request;

class StylistsController extends Controller
{
    public function index()
    {
        return view('admin.stylists.index');
    }

    public function create()
    {
        return view('admin.stylists.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'required',
        ]);

        Stylists::create([
            'name' => $request->name,
            'speciality' => $request->speciality,
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $request->photo,
        ]);

        return redirect()->route('admin.stylists.create')->with('success', 'Data stylist telah berhasil ditambahkan');
    }

    public function edit(Stylists $stylist)
    {
        return view('admin.stylists.edit')->with('stylist', $stylist);
    }

    public function update(Request $request, Stylists $stylist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'speciality' => 'required|string',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'photo' => 'required',
        ]);

        $stylist->update([
            'name' => $request->name,
            'speciality' => $request->speciality,
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $request->photo,
        ]);

        return redirect()->route('admin.stylists.index')->with('success', 'Data stylist telah berhasil diupdate');
    }

    public function destroy(Stylists $stylist)
    {
        $stylist->delete();
        return redirect()->route('admin.stylists.index')->with('success', 'Data stylist telah berhasil dihapus');
    }
}
