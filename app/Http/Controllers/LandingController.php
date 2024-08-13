<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $books = Buku::all();
        return view('welcome', compact('books'));
    }

 

    public function bookDetail($id)
    {
        $book = Buku::findOrFail($id);
        return view('detail', compact('book'));
    }
}