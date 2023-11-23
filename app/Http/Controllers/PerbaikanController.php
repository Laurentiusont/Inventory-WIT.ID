<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Karyawan;
use App\Models\Pemakaian;
use App\Models\Perbaikan;
use Exception;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perbaikans = Perbaikan::with('inventory', 'karyawan_perbaiki', 'karyawan_pemakai')->get();
        $kode_asets = Perbaikan::distinct()->get(["kode_aset"]);
        // dd($perbaikans);
        return view('perbaikan.perbaikan', [
            'perbaikans' => $perbaikans,
            'kode_asets' => $kode_asets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kode_aset = 0)
    {
        $karyawans = Karyawan::all();
        $inventoris = Inventory::all();
        return view('perbaikan.perbaikanCreate', [
            'kode_aset' => $kode_aset,
            'inventoris' => $inventoris,
            'karyawans' => $karyawans,
            'kode_aset' => $kode_aset
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kode_aset = 0)
    {
        try {
            $validatedData = validator(
                $request->all(),
                [
                    'deskripsi' => 'required|string',
                    'tanggal_kerusakan' => 'required|date',
                    'kode_aset' => 'required|string',
                    'nomor_induk' => ''
                ]
            )->validated();

            $perbaikan = new Perbaikan();

            $perbaikan->deskripsi = $validatedData['deskripsi'];

            $perbaikan->tanggal_kerusakan = $validatedData['tanggal_kerusakan'];

            $perbaikan->kode_aset = $validatedData['kode_aset'];

            $perbaikan->pemakai_terakhir = $validatedData['nomor_induk'];


            $perbaikan->save();
            Inventory::where('kode_aset', $validatedData['kode_aset'])->update(['status' => 'rusak']);
            if ($kode_aset != 0) {
                return redirect(route('detailInventory', ['inventory' => $validatedData['kode_aset']]));
            } else {
                return redirect(route('perbaikan'));
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Perbaikan $perbaikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(Perbaikan $perbaikan)
    {

        $inventoris = Inventory::all();
        $karyawans = Karyawan::all();
        if ($perbaikan->id) {
            return view('perbaikan.perbaikanEditDetail', [
                'perbaikan' => $perbaikan,
                'inventoris' => $inventoris,
                'karyawans' => $karyawans
            ]);
        } else {
            return view('perbaikan.perbaikanEdit', [
                'inventoris' => $inventoris,
                'karyawans' => $karyawans
            ]);
        }
    }
    public function editDetail($kode_aset = 0)
    {

        $inventoris = Inventory::all();
        $karyawans = Karyawan::all();
        return view('perbaikan.perbaikanEdit', [
            'inventoris' => $inventoris,
            'karyawans' => $karyawans,
            'kode_aset' => $kode_aset
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perbaikan $perbaikan, $kode_aset = 0)
    {
        try {
            $validatedData = validator(
                $request->all(),
                [
                    'tanggal_perbaikan' => '',
                    'biaya' => '',
                    'deskripsi' => '',
                    'tanggal_kerusakan' => '',
                    'tanggal_selesai_perbaikan' => '',
                    'tempat_perbaikan' => '',
                    'kode_aset' => '',
                    'karyawan_perbaikan' => '',
                    'pemakai_terakhir' => ''
                ]
            )->validated();

            if ($request->tanggal_perbaikan) {
                $perbaikan->tanggal_perbaikan = $validatedData['tanggal_perbaikan'];
            }
            if ($request->biaya) {
                $perbaikan->biaya = $validatedData['biaya'];
            }
            if ($request->deskripsi) {
                $perbaikan->deskripsi = $validatedData['deskripsi'];
            }
            if ($request->tanggal_kerusakan) {
                $perbaikan->tanggal_kerusakan = $validatedData['tanggal_kerusakan'];
            }
            if ($request->tanggal_selesai_perbaikan) {
                $perbaikan->tanggal_selesai_perbaikan = $validatedData['tanggal_selesai_perbaikan'];
            }
            if ($request->tempat_perbaikan) {
                $perbaikan->tempat_perbaikan = $validatedData['tempat_perbaikan'];
            }
            if ($request->kode_aset) {
                $perbaikan->kode_aset = $validatedData['kode_aset'];
            }
            if ($request->karyawan_perbaikan) {
                $perbaikan->karyawan_perbaikan = $validatedData['karyawan_perbaikan'];
            }
            if ($request->pemakai_terakhir) {
                $perbaikan->pemakai_terakhir = $validatedData['pemakai_terakhir'];
            }
            $perbaikan->save();

            if ($request->tanggal_perbaikan && $request->tanggal_selesai_perbaikan) {
                Inventory::where('kode_aset', $validatedData['kode_aset'])->update(['status' => 'normal']);
            } else if ($request->tanggal_perbaikan && $request->tanggal_selesai_perbaikan == null) {
                Inventory::where('kode_aset', $validatedData['kode_aset'])->update(['status' => 'perbaikan']);
            } else if ($request->tanggal_perbaikan == null) {
                Inventory::where('kode_aset', $validatedData['kode_aset'])->update(['status' => 'rusak']);
            }
            if ($kode_aset != 0) {
                return redirect(route('detailInventory', ['inventory' => $validatedData['kode_aset']]));
            } else {
                return redirect(route('perbaikan'));
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perbaikan $perbaikan)
    {
        $perbaikan->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }

    public function destroySpes(Perbaikan $perbaikan)
    {

        $perbaikan->tanggal_perbaikan = null;

        $perbaikan->biaya = null;

        $perbaikan->tanggal_selesai_perbaikan = null;

        $perbaikan->tempat_perbaikan = null;

        $perbaikan->karyawan_perbaikan = null;

        $perbaikan->save();

        Inventory::where('kode_aset',  $perbaikan->kode_aset)->update(['status' => 'rusak']);
        return redirect(route('perbaikan'));
        // return response()->json(['message' => 'Item deleted successfully']);
    }

    public function fetchPerbaikan(Request $request)
    {
        $id = Perbaikan::where('kode_aset', '=', $request->kode_aset)->get()->max('id');
        $data = Perbaikan::with('karyawan_pemakai')->where('id', '=', $id)->get();
        return response()->json($data);
    }
    public function fetchPemakai(Request $request)
    {
        $data = Pemakaian::with('inventory', 'karyawan')->where('kode_aset', '=', $request->kode_aset)->first();
        return response()->json($data);
    }
}