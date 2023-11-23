<?php

namespace App\Http\Controllers;

use App\Models\HistoryPemakaian;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class HistoryPemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemakaians = HistoryPemakaian::with('inventory')->get();
        $karyawans = Karyawan::all();
        $ruangan_olds = HistoryPemakaian::distinct()->get(["ruangan_old"]);
        $ruangan_news = HistoryPemakaian::distinct()->get(["ruangan_new"]);
        $kode_asets = HistoryPemakaian::distinct()->get(["kode_aset"]);
        return view('pemakaian.pemakaian', [
            'pemakaians' => $pemakaians,
            'karyawans' => $karyawans,
            'ruangan_olds' => $ruangan_olds,
            'ruangan_news' => $ruangan_news,
            'kode_asets' => $kode_asets
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
    public function show(HistoryPemakaian $historyPemakaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoryPemakaian $historyPemakaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistoryPemakaian $historyPemakaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryPemakaian $historyPemakaian)
    {
        //
    }
}
