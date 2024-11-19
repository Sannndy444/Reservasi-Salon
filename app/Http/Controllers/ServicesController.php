<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index()
    {
        $service = Services::all();
        return view('admin.services.index', compact('service'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:services,name',
            'description' => 'required|string|max:255',
            'price' => 'required|integer',
            'duration' => 'required|string|max:50',
        ], [
            'name.required' => 'Nama Services Wajib Di Isi.',
            'name.unique' => 'Nama Services Sudah Ada.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route('admin.services.index')
                ->withErrors($validator)
                ->withInput();
        }

        Services::create($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service Berhasil Di Tambahkan.');
    }

    public function show(Services $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Services $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Services $service)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:50',
        ], [
            'name.required' => 'Nama Service Wajib Di Isi.',
            'name.unique' => 'Nama Service Sudah Ada.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.services.edit', $service->id)
                ->withErrors($validator)
                ->withInput();
        }

        $service->update($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service Berhasil Diupdate.');
    }


    public function destroy($id)
    {
        // $service->delete();
        // return redirect()->route('admin.services.index')
        //     ->with('success', 'Service Berhasil Dihapus.');

        try {
            $service = Services::findOrFail($id);
            $service->delete();

            return redirect()->route('admin.services.index')->with('success', 'Service Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.services.index')->with('error', 'Service Tidak Dapat Dihapus.');
        }
    }
}
