<?php

namespace App\Http\Controllers;

use App\Models\Stylists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StylistsController extends Controller
{
    public function index()
    {
        $stylists = Stylists::all();
        return view('admin.stylists.index', compact('stylists'));
    }

    public function create()
    {
        return view('admin.stylists.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:stylists,name',
            'speciality' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:stylists,phone',
            'email' => 'required|string|email|max:255|unique:stylists,email',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2024',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.unique' => 'Nama yang dimasukkan sudah ada di dalam database',
            'phone.unique' => 'Nomor handphone yang dimasukkan sudah ada di dalam database',
            'email.unique' => 'Email yang dimasukkan sudah ada di dalam database',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route('admin.stylists.index')
                ->withErrors($validator)
                ->withInput();
        }

            $data = $request->all();
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('photos', 'public');
            }

            Stylists::create($data);

            return redirect()->route('admin.stylists.index', compact('stylists'))
                ->with('success', 'Data stylist telah berhasil ditambahkan');

    }

    public function show(Stylists $stylist)
    {
        return view('admin.stylists.show', compact('stylists'));
    }

    public function edit(Stylists $stylist)
    {
        return view('admin.stylists.edit', compact('stylists'));
    }

    public function update(Request $request, Stylists $stylist)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:stylists,name',
            'speciality' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:stylists,phone',
            'email' => 'required|string|email|max:255|unique:stylists,email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:1024',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.unique' => 'Nama yang dimasukkan sudah ada di dalam database',
            'phone.unique' => 'Nomor handphone yang dimasukkan sudah ada di dalam database',
            'email.unique' => 'Email yang dimasukkan sudah ada di dalam database',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route('admin.stylists.index')
                ->withErrors($validator)
                ->withInput();
        }

        $stylist->update($request->all());
        return redirect()->route('admin.stylists.index')
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy(Stylists $stylist)
    {
        $stylist->delete();
        return redirect()->route('admin.stylists.index')->with('success', 'Stylist berhasil dihapus');
    }
}
