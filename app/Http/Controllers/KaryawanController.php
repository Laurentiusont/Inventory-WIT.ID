<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        $divisions = Karyawan::distinct()->get(["divisi"]);
        $jabatans = Karyawan::distinct()->get(["jabatan"]);
        return view('karyawan.karyawan', [
            'karyawans' => $karyawans,
            'divisions' => $divisions,
            'jabatans' => $jabatans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.karyawanCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = validator(
                $request->all(),
                [
                    'nomor_induk' => 'required|string',
                    'gambar' => 'image|file|max:1024',
                    'nama' => 'required|string',
                    'gender' => 'required|int',
                    'email' => 'required|string',
                    'telepon' => 'required|string',
                    'jabatan' => 'required|string',
                    'divisi' => 'required|string',
                    'alamat' => 'required|string',
                ]
            )->validated();

            if ($request->file('gambar')) {
                $validatedData['gambar'] = $request->file('gambar')->store('post-images');
            }

            $karyawan = new Karyawan();
            $karyawan->nomor_induk = $validatedData['nomor_induk'];
            if ($request->file('gambar')) {
                $karyawan->img_url = $validatedData['gambar'];
            }
            $karyawan->nama = $validatedData['nama'];
            $karyawan->gender = $validatedData['gender'];
            $karyawan->email = $validatedData['email'];
            $karyawan->telepon = $validatedData['telepon'];
            $karyawan->jabatan = $validatedData['jabatan'];
            $karyawan->divisi = $validatedData['divisi'];
            $karyawan->alamat = $validatedData['alamat'];
            $karyawan->save();
            return redirect(route('karyawan'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(Karyawan $karyawan)
    {
        return view('karyawan.karyawanDetail', [
            'karyawan' => $karyawan,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.karyawanEdit', [
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $validatedData = validator(
            $request->all(),
            [
                'nomor_induk' => 'required|string',
                'gambar' => 'image|file|max:1024',
                'nama' => 'required|string',
                'gender' => 'required|int',
                'email' => 'required|string',
                'telepon' => 'required|string',
                'jabatan' => 'required|string',
                'divisi' => 'required|string',
                'alamat' => 'required|string',
            ]
        )->validated();

        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('post-images');
        } else {
            $validatedData['gambar'] = $request->oldImage;
        }

        $karyawan->nomor_induk = $validatedData['nomor_induk'];
        $karyawan->img_url = $validatedData['gambar'];
        $karyawan->nama = $validatedData['nama'];
        $karyawan->gender = $validatedData['gender'];
        $karyawan->email = $validatedData['email'];
        $karyawan->telepon = $validatedData['telepon'];
        $karyawan->jabatan = $validatedData['jabatan'];
        $karyawan->divisi = $validatedData['divisi'];
        $karyawan->alamat = $validatedData['alamat'];
        $karyawan->save();
        return redirect(route('karyawan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        if ($karyawan->gambar) {
            Storage::delete($karyawan->gambar);
            // Tambahkan pernyataan log atau pesan debug di sini
            Log::info('File deleted successfully.');
            Log::info('Destroy method is called.');
        }

        $karyawan->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
