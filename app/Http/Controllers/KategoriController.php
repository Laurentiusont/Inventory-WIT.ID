<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::withCount('inventory')->get();
        return view('kategori.kategori', [
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.kategoriCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'id_kategori' => 'required|string',
            'nama' => 'required|string',
        ])->validated();

        $kategori = new Kategori();
        $kategori->id_kategori = $validatedData['id_kategori'];
        $kategori->nama = $validatedData['nama'];
        $kategori->save();

        return redirect('kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.kategoriEdit', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validatedData = validator($request->all(), [
            'id_kategori' => 'required|string',
            'nama' => 'required|string',
        ])->validated();

        $kategori->id_kategori = $validatedData['id_kategori'];
        $kategori->nama = $validatedData['nama'];
        $kategori->save();
        return redirect(route('kategori'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
