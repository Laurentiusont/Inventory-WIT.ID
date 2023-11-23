<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Ruangan;
use Exception;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangans = Ruangan::with('kantor')->withCount('pemakaian')->get();
        return view('ruangan.ruangan', [
            'ruangans' => $ruangans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kantors=Kantor::all();
        return view('ruangan.ruanganCreate', [
        'kantors' => $kantors
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'id_ruangan' => 'required|string',
            'nama' => 'required|string',
            'lantai' => 'required|string',
            'kantor' => ''
        ])->validated();

        $ruangan = new Ruangan();
        $ruangan->id_ruangan = $validatedData['id_ruangan'];
        $ruangan->nama = $validatedData['nama'];
        $ruangan->lantai = $validatedData['lantai'];
        $ruangan->id_kantor = $validatedData['kantor'];
        $ruangan->save();

        return redirect('ruangan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        $kantors=Kantor::all();
        return view('ruangan.ruanganEdit', [
            'ruangan' => $ruangan, 
            'kantors' => $kantors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    { try{
        $validatedData = validator($request->all(), [
            'id_ruangan' => 'required|string',
            'nama' => 'required|string',
            'lantai' => 'required|string',
            'kantor' => ''
        ])->validated();

        $ruangan->id_ruangan = $validatedData['id_ruangan'];
        $ruangan->nama = $validatedData['nama'];
        $ruangan->lantai = $validatedData['lantai'];
        $ruangan->id_kantor = $validatedData['kantor'];
        $ruangan->save();
        return redirect()->route('ruangan');
    } catch (Exception $ex) {
        dd($ex);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
