<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\RakBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('bukus.index', compact('bukus'));
    }

    public function create()
    {
        $rak_bukus = RakBuku::all();
        return view('bukus.create', compact('rak_bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rak' => 'required',
            'nama_rak' => 'required',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'jenis_buku' => 'required|string|max:255',
            'stok_tersedia' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
            'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_buku' => 'nullable',
        ]);

        $data = $request->except('_token');
        if ($request->hasFile('foto_sampul')) {
            $data['foto_sampul'] = $request->file('foto_sampul')->store('foto_sampul', 'public');
        }
        if ($request->hasFile('file_buku')) {
            $data['file_buku'] = $request->file('file_buku')->store('file_buku', 'public');
        }

        Buku::create($data);
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dibuat.');
    }

    public function show(Buku $buku)
    {
        return view('bukus.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $rak_bukus = RakBuku::all();
        return view('bukus.edit', compact('buku', 'rak_bukus'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'nomor_rak' => 'required',
            'nama_rak' => 'required',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'jenis_buku' => 'required|string|max:255',
            'stok_tersedia' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
            'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_buku' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = $request->except('_token');
        if ($request->hasFile('foto_sampul')) {
            // Hapus foto sampul lama jika ada
            if ($buku->foto_sampul) {
                Storage::disk('public')->delete($buku->foto_sampul);
            }
            $data['foto_sampul'] = $request->file('foto_sampul')->store('foto_sampul', 'public');
        }
        if ($request->hasFile('file_buku')) {
            // Hapus file buku lama jika ada
            if ($buku->file_buku) {
                Storage::disk('public')->delete($buku->file_buku);
            }
            $data['file_buku'] = $request->file('file_buku')->store('file_buku', 'public');
        }

        $buku->update($data);
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        // Hapus file jika ada
        if ($buku->foto_sampul) {
            Storage::disk('public')->delete($buku->foto_sampul);
        }
        if ($buku->file_buku) {
            Storage::disk('public')->delete($buku->file_buku);
        }
        
        $buku->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus.');
    }
}
