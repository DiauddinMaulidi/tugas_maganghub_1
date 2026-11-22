<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // mengambil semua user dgn rolenya
        $users = User::with('roles')->get();

        // mengirim data ke halaman Blade
        return view('admin.dashboard', compact('users'));
    }
}
