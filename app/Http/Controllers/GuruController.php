<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index() {
        $gurus = Guru::latest()->get();

        return view('admin.guru.index', compact('gurus'));
    }

    // public function create()
    // {
        
    // }

    // public function store(Request $request)
    // {
        
    // }

    // public function show(string $id)
    // {
        
    // }


    // public function edit(string $id)
    // {
        
    // }

    // public function update(Request $request, string $id)
    // {
        
    // }

    // public function destroy(string $id)
    // {
        
    // }
}
