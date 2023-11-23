<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kantors = Kantor::all();
        return view('kantor.kantor', [
            'kantors' => $kantors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kantor.kantorCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'alamat' => 'required|string', 
            'telepon' => 'required|string'
        ])->validated();

        $kantor = new Kantor();
        $kantor->kota = $validatedData['kota'];
        $kantor->kecamatan = $validatedData['kecamatan'];
        $kantor->alamat = $validatedData['alamat'];
        $kantor->telepon = $validatedData['telepon'];
        $kantor->save();

        return redirect('kantor');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kantor $kantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kantor $kantor)
    {
        return view('kantor.kantorEdit', [
            'kantor' => $kantor 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kantor $kantor)
    {
        $validatedData = validator($request->all(), [
            'kota' => '',
            'kecamatan' => '',
            'alamat' => '', 
            'telepon' => ''
        ])->validated();

        $kantor->kota = $validatedData['kota'];
        $kantor->kecamatan = $validatedData['kecamatan'];
        $kantor->alamat = $validatedData['alamat'];
        $kantor->telepon = $validatedData['telepon'];
        $kantor->save();

        return redirect('kantor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kantor $kantor)
    {
        $kantor->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
