<?php

namespace App\Http\Controllers;

use App\Models\Stylists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048|unique:stylists,photo',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.unique' => 'Nama yang dimasukkan sudah ada di dalam database',
            'phone.unique' => 'Nomor handphone yang dimasukkan sudah ada di dalam database',
            'email.unique' => 'Email yang dimasukkan sudah ada di dalam database',
            'photo.unique' => 'Foto stylists wajib di ada'
        ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->route('admin.stylists.index')
                                ->withErrors($validator)
                                ->withInput();
            }

            // dd($request);


        // $imageName = $imageName->photo;

            if ($request->hasFile('photo')) {
                    $image = $request->file('photo');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();

                    $image->storeAs('photos', $imageName, 'public');

            }
            Stylists::create([
                'name' => $request->name,
                'speciality' => $request->speciality,
                'phone' => $request->phone,
                'email' => $request->email,
                'photo' => $imageName
            ]);

            return redirect()->route('admin.stylists.index')
                            ->with('success', 'Data employee telah berhasil ditambahkan');
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
            'name' => 'nullable|string|max:255|unique:stylists,name,' . $stylist->id,
            'speciality' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255|unique:stylists,phone,' . $stylist->id,
            'email' => 'nullable|string|email|max:255|unique:stylists,email,' . $stylist->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'name.unique' => 'Nama Employee Sudah Ada',
            'phone.unique' => 'Nomer Sudah Ada K',
            'email.unique' => 'Email Sudah Ada K'
        ]);

        if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->route('admin.stylists.index')
                                ->withErrors($validator)
                                ->withInput();
            }

        $imageName = $stylist->photo;

            if ($request->hasFile('photo')) {
                    if ($stylist->photo && file_exists(storage_path('app/public/photos/' . $stylist->photo))) {
                        unlink(storage_path('app/public/photos/' . $stylist->photo));
                    }

                    $image = $request->file('photo');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('photos', $imageName, 'public');

            }

            // Update data stylist
            $stylist->update([
                'name' => $request->name,
                'speciality' => $request->speciality,
                'phone' => $request->phone,
                'email' => $request->email,
                'photo' => $imageName,
            ]);

        return redirect()->route('admin.stylists.index')
                        ->with('success', 'Employee Berhasil Di Update');
    }

    public function destroy(Stylists $stylist)
    {
        if (storage::disk('public')->exists($stylist->photo)) {
            storage::disk('public')->delete($stylist->photo);
        }

        $stylist->delete();
        return redirect()->route('admin.stylists.index')->with('success', 'Employee berhasil dihapus');
    }
}
