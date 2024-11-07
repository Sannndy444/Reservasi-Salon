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
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $data = $request->all();
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('photos', 'public');
            }

            Stylists::create($data);

            return redirect()->route('admin.stylists.index')
                ->with('success', 'Data stylist telah berhasil ditambahkan');
        }

    }

    public function show(Stylists $stylist)
    {
        return view('admin.stylists.show', compact('stylists'));
    }

    public function edit(Stylists $stylist)
    {
        return view('admin.stylists.edit', compact('stylist'));
    }

    public function update(Request $request, Stylists $stylist)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255|unique:stylists,name',
            'speciality' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255|unique:stylists,phone',
            'email' => 'nullable|string|email|max:255|unique:stylists,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
        ]);
            if ($request->hasFile('photo')) {
                if ($stylist->image && file_exists(storage_path('app/public/photos'. $stylist->image))) {
                    unlink(storage_path('app/public/photos' . $stylist->image));
                }

                $image = $request->file('photo');
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('photos', $imageName, 'public');
            } else {
                $imageName = $stylist->image;
            }

        $stylist->update([
            'name' => $request->name,
            'speciality' => $request->speciality,
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $imageName,
        ]);

        return redirect()->route('admin.stylists.index')
                        ->with('success', 'Stylists Berhasil Di Update');
    }

    public function destroy(Stylists $stylist)
    {
        if ($stylist->image && file_exists(storage_path('app/public/photos' . $stylist->image))) {
            unlink(storage_path('app/public/photos' . $stylist->image));
        }

        $stylist->delete();
        return redirect()->route('admin.stylists.index')->with('success', 'Stylist berhasil dihapus');
    }
}
