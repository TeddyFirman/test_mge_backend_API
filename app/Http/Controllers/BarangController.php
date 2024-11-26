<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use App\Models\BarangHarga;
use App\Models\MasterBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        return response()->json(MasterBarang::all());
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'nullable|string',
            'harga' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $counter = MasterBarang::count() + 1;
        $kodeBarang = 'BRG/' . date('y') . '/' . date('m') . '/' . str_pad($counter, 5, '0', STR_PAD_LEFT);

        $fotoPath = $request->hasFile('foto') ? $request->file('foto')->store('uploads/barang') : null;

        $barang = MasterBarang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $kodeBarang,
            'stok' => $request->stok ?? 0,
            'harga' => $request->harga,
            'foto' => $fotoPath,
        ]);

        return response()->json(['message' => 'Barang berhasil ditambahkan', 'data' => $barang], 201);
    }

    public function update(Request $request, $id)
    {
        $barang = MasterBarang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|string',
            'harga' => 'required|string',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/barang');
            $barang->foto = $fotoPath;
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'foto' => $barang->foto,
        ]);

        return response()->json(['message' => 'Barang berhasil diupdate', 'data' => $barang]);
    }

    public function destroy($id)
    {
        $barang = MasterBarang::findOrFail($id);

        $barang->delete();

        return response()->json(['message' => 'Barang berhasil dihapus']);
    }

    public function updateStock(Request $request, $id)
    {
        $barang = MasterBarang::findOrFail($id);

        $request->validate([
            'stok' => 'required|integer',
        ]);

        $barang->stok += $request->stok;
        $barang->save();

        return response()->json(['message' => 'Stok berhasil diperbarui', 'stok' => $barang->stok]);
    }

    public function minusStock(Request $request, $id)
    {
        $barang = MasterBarang::findOrFail($id);

        $request->validate([
            'stok' => 'required|integer',
        ]);

        $barang->stok -= $request->stok;
        $barang->save();

        return response()->json(['message' => 'Stok berhasil diperbarui', 'stok' => $barang->stok]);
    }

    public function addHarga(Request $request, $id)
    {
        $request->validate([
            'harga' => 'required|numeric',
            'tanggal_berlaku' => 'required|date',
        ]);

        $harga = BarangHarga::create([
            'barang_id' => $id,
            'harga' => $request->harga,
            'tanggal_berlaku' => $request->tanggal_berlaku,
        ]);

        return response()->json(['message' => 'Harga berhasil ditambahkan', 'data' => $harga]);
    }

    public function getStockByDate($date)
    {
        $barang = MasterBarang::select('nama_barang', 'stok')
            ->whereDate('updated_at', $date)
            ->get();

        return response()->json($barang);
    }

    public function getHargaByDate($date)
    {
        $harga = BarangHarga::with('barang:nama_barang')
            ->whereDate('tanggal_berlaku', $date)
            ->get(['barang_id', 'harga']);

        return response()->json($harga);
    }

    // SEARCH
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $search = MasterBarang::where('nama_barang', 'like', '%' . $keyword . '%')->get();

        return response()->json(['Hasil Pencarian' => $search]);
    }
}
