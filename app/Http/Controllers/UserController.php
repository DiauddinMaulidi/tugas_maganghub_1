<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // mengambil semua user dgn rolenya
        $users = User::with('role')->get();

        // mengirim data ke halaman Blade
        return view('users.index', compact('users'));
    }
}
