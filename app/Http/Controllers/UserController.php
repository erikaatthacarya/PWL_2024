<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM m_user'); // Ambil semua data dari tabel
        return view('user', ['data' => $data]);
    }
}
