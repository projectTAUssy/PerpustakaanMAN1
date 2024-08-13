<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;


class VisitController extends Controller
{
    public function index()
    {
   
        $visits = Visit::with('user')->orderBy('visited_at', 'desc')->get();

        return view('pengunjung.index', compact('visits'));
    }
}