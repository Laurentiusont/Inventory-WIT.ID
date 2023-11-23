<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use App\Models\Karyawan;
use App\Models\Inventory;
use App\Models\Kategori;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }





    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalMale = Karyawan::where('gender', '0')->count();
        $totalFemale = Karyawan::where('gender', '1')->count();

        $kategori = Kategori::withCount('inventory')->get();
        $ruangan = Ruangan::withCount('pemakaian')->get();

        $pemakaians = Pemakaian::with('inventory')->get();
        $inventory = Inventory::all();
        
        $status = $inventory->groupBy('status');
        $available = count($pemakaians->where('nomor_induk', '=', null));
        $dipakai = count($pemakaians->where('nomor_induk', '!=', null));
        $karyawans = Karyawan::all();
        $depresiasi = Inventory::get(['tahun_1', 'tahun_2', 'tahun_3', 'tahun_4']);
        $labelsStatus = [];
        $valuesStatus = [];
        foreach ($status as $label => $values) {
            $labelsStatus[] = $label;
            $valuesStatus[] = count($values);
        }
        return view('dashboard', [
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
            'kategoris' => $kategori,
            'ruangans' => $ruangan,
            'pemakaians' => $pemakaians,
            'karyawans' => $karyawans,
            'inventory' => $inventory,
            'labelsStatus' => $labelsStatus,
            'valuesStatus' => $valuesStatus,
            'available' => $available,
            'dipakai' => $dipakai,
            'depresiasi' => $depresiasi
        ]);
    }
}
