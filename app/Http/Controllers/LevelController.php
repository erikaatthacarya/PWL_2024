<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // DB::insert('insert into m_level (level_kode, level_nama, created_at) values (?, ?, ?)', 
        // ['cus', 'Pelanggan', now()]);

        // return 'Insert data baru berhasil';

        // $row = DB::update('UPDATE m_level SET level_nama = ? WHERE level_kode = ?', ['customer', 'cus']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // $row = DB::delete('delete from m_level where level_kode = ?', ['cus']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        $data = DB::table('m_level')->get();
        return view('level', ['data' => $data]);                
    }
}

