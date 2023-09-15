<?php

namespace App\Http\Controllers;

use App\Models\DataKaryawan;
use Illuminate\Http\Request;

class DataKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKaryawans=DataKaryawan::all();
        return view('tables',[
            'datakaryawans'=>$dataKaryawans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tablesCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'nama_karyawan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|string|max:45',
            'email' => 'required|string|max:45',          
            'telepon' => 'required|string|max:15',
            'jabatan' => 'required|string|max:45',
            'divisi' => 'required|string|max:45',
            'alamat' => 'required|string|max:45'
        ])->validate();
        $dataKaryawan = new DataKaryawan(); 
        $dataKaryawan -> nama_karyawan = $validatedData['nama_karyawan'];
        $dataKaryawan -> jenis_kelamin = $validatedData['jenis_kelamin'];
        $dataKaryawan -> email = $validatedData['email'];
        $dataKaryawan -> telepon = $validatedData['telepon'];
        $dataKaryawan -> jabatan = $validatedData['jabatan'];
        $dataKaryawan -> divisi = $validatedData['divisi'];
        $dataKaryawan -> alamat = $validatedData['alamat'];
        $dataKaryawan -> save();
        return redirect(route('tables'));
    }

    /**
     * Display the specified resource.
     */
    public function show(DataKaryawan $dataKaryawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataKaryawan $dataKaryawan,$idkaryawan)
    {
        $datakaryawana = DataKaryawan::where('id_karyawan', $idkaryawan)->first();

        if ($datakaryawana) {
            return view('tablesEdit', [
                'datakaryawana' => $datakaryawana,
                'idkaryawan' => $idkaryawan,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataKaryawan $dataKaryawan,$idkaryawan)
    {
        $validatedData = validator($request->all(), [
            'id_karyawan' => 'required|string|max:100',
            'nama_karyawan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|string|max:100',
            'email' => 'required|string|max:100',          
            'telepon' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'divisi' => 'required|string|max:100',
            'alamat' => 'required|string|max:100'
        ])->validate();

        $dataKaryawan->where('id_karyawan', $idkaryawan)->update([
            'nama_karyawan' => $validatedData['nama_karyawan'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'email' => $validatedData['email'],
            'telepon' => $validatedData['telepon'],
            'jabatan' => $validatedData['jabatan'],
            'divisi' => $validatedData['divisi'],
            'alamat' => $validatedData['alamat']
        ]);

        return redirect(route('tables'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataKaryawan $dataKaryawan,$idkaryawan)
    {
    $dataKaryawan = DataKaryawan::where('id_karyawan', $idkaryawan);

    if ($dataKaryawan) {
        $dataKaryawan->delete();
    }

    return redirect()->route('tables');
    }
}
