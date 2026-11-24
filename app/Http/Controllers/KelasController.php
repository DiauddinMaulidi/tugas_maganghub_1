<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('waliKelas')
            ->withCount('siswas')
            ->latest()
            ->get();

        return view('admin.dashboard', compact('kelas'));
    }
}
