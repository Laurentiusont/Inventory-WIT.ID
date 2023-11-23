<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemakaians = Pemakaian::with('inventory')->get();
        $karyawans = Karyawan::all();
        return view('pemakaian.pemakaian', [
            'pemakaians' => $pemakaians,
            'karyawans' => $karyawans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemakaian $pemakaian, $kodeAset = '0')
    {
        $validatedData = validator($request->all(), [
            'id_ruangan' => '',
            'nomor_induk' => '',
        ])->validated();

        if ($request->id_ruangan) {
            $pemakaian->id_ruangan = $validatedData['id_ruangan'];
        }
        if ($request->nomor_induk) {
            $pemakaian->nomor_induk = $validatedData['nomor_induk'];
        }
        $pemakaian->save();
        if ($kodeAset == '0') {
            return redirect(route('inventory'));
        } else {
            return redirect(route('detailInventory', ['inventory' => $kodeAset]));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemakaian $pemakaian)
    {
        //
    }
}
