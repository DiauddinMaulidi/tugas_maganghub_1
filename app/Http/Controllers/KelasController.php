<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('guru')
            ->withCount('siswas')
            ->latest()
            ->get();

        return view('admin.dashboard', compact('kelas'));
    }
}
