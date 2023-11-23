<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Karyawan;
use App\Models\Kategori;
use App\Models\Pemakaian;
use App\Models\Perbaikan;
use App\Models\Ruangan;
use App\Models\Kantor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('kategori', 'karyawan', 'pemakaian', 'history_perbaikan')->get();
        $kategoris =  Inventory::with('kategori', 'karyawan', 'pemakaian')->distinct()->get(["id_kategori"]);
        $merks =  Inventory::with('kategori', 'karyawan', 'pemakaian')->distinct()->get(["merk"]);
        $statuses =  Inventory::with('kategori', 'karyawan', 'pemakaian')->distinct()->get(["status"]);
        $ruangans =  Pemakaian::with('ruangan')->distinct()->get(["id_ruangan"]);
        return view('inventory.inventory', [
            'inventories' => $inventories,
            'kategoris' => $kategoris,
            'merks' => $merks,
            'statuses' => $statuses,
            'ruangans' => $ruangans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        $kategoris = Kategori::all();
        return view('inventory.inventoryCreate', [
            'karyawans' => $karyawans,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        try {
            $validatedData = validator($request->all(), [
                'kode_aset' => 'required|string',
                'gambar' => 'image|file|max:1024',
                'nama' => 'required|string',
                'merk' => 'required|string',
                'tanggal' => 'required|date',
                'harga' => 'required|int',
                'deskripsi' => 'required|string',
                'id_kategori' => 'required|string',
                'vendor' => 'required|string',
                'nomor_induk' => 'required|string',
            ])->validated();

            if ($request->file('gambar')) {
                $validatedData['gambar'] = $request->file('gambar')->store('post-images');
            }

            $inventory = new Inventory();
            if ($request->file('gambar')) {
                $inventory->img_url = $validatedData['gambar'];
            }

            $inventory->kode_aset = $validatedData['kode_aset'];
            $inventory->nama = $validatedData['nama'];
            $inventory->merk = $validatedData['merk'];
            $inventory->tanggal = $validatedData['tanggal'];
            $inventory->harga = $validatedData['harga'];
            $inventory->deskripsi = $validatedData['deskripsi'];
            $inventory->status = 'normal';
            $inventory->id_kategori = $validatedData['id_kategori'];
            $inventory->nomor_induk = $validatedData['nomor_induk'];
            $inventory->vendor = $validatedData['vendor'];

            $inventory->save();

            $pemakaian = new Pemakaian();
            $pemakaian->kode_aset = $validatedData['kode_aset'];
            $pemakaian->save();

            return redirect('inventory');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(Inventory $inventory)
    {
        // dd($inventory);
        $karyawans = Karyawan::all();
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();
        // $perbaikan = '';
        // $id = Perbaikan::where('kode_aset', '=', $inventory->kode_aset)->get()->max('id');
        // $perbaikans = Perbaikan::where('id', '=', $id)->get();
        // if ($id) {
        //     $perbaikans = Perbaikan::where('id', '=', $id)->get();
        //     $perbaikan = $perbaikans[0];
        // }


        return view('inventory.inventoryDetail', [
            'inventory' => $inventory,
            'karyawans' => $karyawans,
            'kategoris' => $kategoris,
            'ruangans'  => $ruangans,
            // 'perbaikan' => $perbaikan,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $kantors = Kantor::all();
        $karyawans = Karyawan::all();
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();
        return view('inventory.inventoryEdit', [
            'inventory' => $inventory,
            'karyawans' => $karyawans,
            'kategoris' => $kategoris,
            'ruangans'  => $ruangans,
            'kantors' => $kantors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        try {
            $validatedData = validator($request->all(), [
                'kode_aset' => 'required|string',
                'gambar' => 'image|file|max:1024',
                'nama' => 'required|string',
                'merk' => 'required|string',
                'tanggal' => 'required|date',
                'harga' => 'required|int',
                'nilai_residu' => '',
                'masa_manfaat' => '',
                'depresiasi' => '',
                'deskripsi' => 'required|string',
                'status' => '',
                'id_kategori' => 'required|string',
                'nomor_induk' => 'required|string',
                'tahun_1' => '',
                'tahun_2' => '',
                'tahun_3' => '',
                'tahun_4' => '',
                'vendor' => 'required|string',

            ])->validated();
            if ($request->nomor_induk_pemakai || $request->id_ruangan) {
                $validatedDataPemakaian = validator($request->all(), [
                    'nomor_induk_pemakai' => '',
                    'id_ruangan' => '',
                ])->validated();
                if ($request->nomor_induk_pemakai) {
                    $inventory->pemakaian->nomor_induk = $validatedDataPemakaian['nomor_induk_pemakai'];
                }
                if ($request->id_ruangan) {
                    $inventory->pemakaian->id_ruangan = $validatedDataPemakaian['id_ruangan'];
                }
                $inventory->pemakaian->save();
            }
            if ($request->file('gambar')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validatedData['gambar'] = $request->file('gambar')->store('post-images');
            } else {
                $validatedData['gambar'] = $request->oldImage;
            }
            $inventory->img_url = $validatedData['gambar'];
            $inventory->kode_aset = $validatedData['kode_aset'];
            $inventory->nama = $validatedData['nama'];
            $inventory->merk = $validatedData['merk'];
            $inventory->tanggal = $validatedData['tanggal'];
            $inventory->harga = $validatedData['harga'];
            $inventory->nilai_residu = $validatedData['nilai_residu'];
            $inventory->masa_manfaat = $validatedData['masa_manfaat'];
            $inventory->depresiasi = $validatedData['depresiasi'];
            $inventory->deskripsi = $validatedData['deskripsi'];
            $inventory->status = $validatedData['status'];
            $inventory->id_kategori = $validatedData['id_kategori'];
            $inventory->nomor_induk = $validatedData['nomor_induk'];
            $inventory->tahun_1 = $validatedData['tahun_1'];
            $inventory->tahun_2 = $validatedData['tahun_2'];
            $inventory->tahun_3 = $validatedData['tahun_3'];
            $inventory->tahun_4 = $validatedData['tahun_4'];
            $inventory->vendor = $validatedData['vendor'];
            $inventory->save();

            return redirect('inventory');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function updateDetail(Request $request, Inventory $inventory)
    {
        // dd($request->merk);
        try {
            $validatedData = validator($request->all(), [
                'kode_aset' => '',
                'img_url' => '',
                'nama' => '',
                'merk' => '',
                'tanggal' => '',
                'harga' => '',
                'nilai_residu' => '',
                'masa_manfaat' => '',
                'depresiasi' => '',
                'deskripsi' => '',
                'status' => '',
                'id_kategori' => '',
                'nomor_induk' => '',
                'tahun_1' => '',
                'tahun_2' => '',
                'tahun_3' => '',
                'tahun_4' => '',
                'vendor' => '',
            ])->validated();
            if ($request->file('gambar')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validatedData['img_url'] = $request->file('img_url')->store('post-images');
            } else {
                $validatedData['img_url'] = $request->oldImage;
            }

            if ($request->kode_aset) {
                $inventory->kode_aset = $validatedData['kode_aset'];
            }
            if ($request->nama) {
                $inventory->nama = $validatedData['nama'];
            }
            if ($request->merk) {
                $inventory->merk = $validatedData['merk'];
            }
            if ($request->tanggal) {
                $inventory->tanggal = $validatedData['tanggal'];
            }
            if ($request->harga) {
                $inventory->harga = $validatedData['harga'];
                if ($inventory->masa_manfaat) {
                    $manfaat = $inventory->masa_manfaat;
                    $harga = $validatedData['harga'];
                    if ($manfaat <= 4) {
                        $residu = $harga * 0.25;
                    } elseif ($manfaat <= 8 or $manfaat > 4) {
                        $residu = $harga * 0.125;
                    } elseif ($manfaat <= 16 or $manfaat > 8) {
                        $residu = $harga * 0.0625;
                    } elseif ($manfaat <= 20 or $manfaat > 16) {
                        $residu = $harga * 0.05;
                    }
                    $depresiasi1 = ($harga - $residu) / $manfaat;
                    $tahun1 = $harga - $depresiasi1;
                    $tahun2 = $tahun1 - $depresiasi1;
                    $tahun3 = $tahun2 - $depresiasi1;
                    $tahun4 = $tahun3 - $depresiasi1;

                    $inventory->nilai_residu = $residu;
                    $inventory->depresiasi = $depresiasi1;
                    $inventory->tahun_1 = $tahun1;
                    $inventory->tahun_2 = $tahun2;
                    $inventory->tahun_3 = $tahun3;
                    $inventory->tahun_4 = $tahun4;
                }
            }
            if ($request->nilai_residu) {
                $inventory->nilai_residu = $validatedData['nilai_residu'];
            }
            if ($request->masa_manfaat) {
                $inventory->masa_manfaat = $validatedData['masa_manfaat'];
                if ($inventory->harga) {
                    $manfaat = $validatedData['masa_manfaat'];
                    $harga = $inventory->harga;
                    if ($manfaat <= 4) {
                        $residu = $harga * 0.25;
                    } elseif ($manfaat <= 8 or $manfaat > 4) {
                        $residu = $harga * 0.125;
                    } elseif ($manfaat <= 16 or $manfaat > 8) {
                        $residu = $harga * 0.0625;
                    } elseif ($manfaat <= 20 or $manfaat > 16) {
                        $residu = $harga * 0.05;
                    }
                    $depresiasi1 = ($harga - $residu) / $manfaat;
                    $tahun1 = $harga - $depresiasi1;
                    $tahun2 = $tahun1 - $depresiasi1;
                    $tahun3 = $tahun2 - $depresiasi1;
                    $tahun4 = $tahun3 - $depresiasi1;

                    $inventory->nilai_residu = $residu;
                    $inventory->depresiasi = $depresiasi1;
                    $inventory->tahun_1 = $tahun1;
                    $inventory->tahun_2 = $tahun2;
                    $inventory->tahun_3 = $tahun3;
                    $inventory->tahun_4 = $tahun4;
                }
            }
            if ($request->depresiasi) {
                $inventory->depresiasi = $validatedData['depresiasi'];
            }
            if ($request->deskripsi) {
                $inventory->deskripsi = $validatedData['deskripsi'];
            }
            if ($request->status) {
                $inventory->status = $validatedData['status'];
            }
            if ($request->id_kategori) {
                $inventory->id_kategori = $validatedData['id_kategori'];
            }
            if ($request->nomor_induk) {
                $inventory->nomor_induk = $validatedData['nomor_induk'];
            }
            if ($request->tahun_1) {
                $inventory->tahun_1 = $validatedData['tahun_1'];
            }
            if ($request->tahun_2) {
                $inventory->tahun_2 = $validatedData['tahun_2'];
            }
            if ($request->tahun_3) {
                $inventory->tahun_3 = $validatedData['tahun_3'];
            }
            if ($request->tahun_4) {
                $inventory->tahun_4 = $validatedData['tahun_4'];
            }
            if ($request->vendor) {
                $inventory->vendor = $validatedData['vendor'];
            }

            $inventory->save();

            return redirect()->route('detailInventory', ['inventory' => $inventory->kode_aset]);
        } catch (Exception $ex) {
            dd($ex);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        if ($inventory->gambar) {
            Storage::delete($inventory->gambar);
        }

        $inventory->delete();

        // Flash a success message for SweetAlert
        return redirect()->route('inventory');
    }
}
