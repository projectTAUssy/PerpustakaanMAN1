<?php
namespace App\Http\Controllers;

use App\Models\RakBuku;
use Illuminate\Http\Request;

class RakBukuController extends Controller
{
    public function index()
    {
        $rakBuku = RakBuku::all();
        return view('rak_bukus.index', compact('rakBuku'));
    }

    public function show($nomor_rak)
    {
        $rakBuku = RakBuku::where('nomor_rak', $nomor_rak)->firstOrFail();
        return view('rak_bukus.show', compact('rakBuku'));
    }

    public function create()
    {
        return view('rak_bukus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rak' => 'required|string|max:50|unique:rak_bukus',
            'nama_rak' => 'required|string|max:100',
        ]);

        RakBuku::create($request->all());

        return redirect()->route('rak_bukus.index')->with('success', 'Rak buku berhasil ditambahkan.');
    }

    public function edit($nomor_rak)
    {
        $rakBuku = RakBuku::where('nomor_rak', $nomor_rak)->firstOrFail();
        return view('rak_bukus.edit', compact('rakBuku'));
    }

    public function update(Request $request, $nomor_rak)
    {
        $request->validate([
            'nama_rak' => 'required|string|max:100',
        ]);

        $rakBuku = RakBuku::where('nomor_rak', $nomor_rak)->firstOrFail();
        $rakBuku->update($request->all());

        return redirect()->route('rak_bukus.index')->with('success', 'Rak buku berhasil diperbarui.');
    }

    public function destroy($nomor_rak)
    {
        $rakBuku = RakBuku::where('nomor_rak', $nomor_rak)->firstOrFail();
        $rakBuku->delete();

        return redirect()->route('rak_bukus.index')->with('success', 'Rak buku berhasil dihapus.');
    }
}


