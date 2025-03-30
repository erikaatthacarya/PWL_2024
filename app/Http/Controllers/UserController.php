<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // // Mengambil satu pengguna dengan id = 1
        // $users = UserModel::find(1);
    
        // // Mengubah objek menjadi array agar bisa di-loop
        // $users = $users ? [$users] : []; // Jika tidak ditemukan, buat array kosong
    
        // return view('user', ['data' => $users]);

        

        // $user = UserModel::where('level_id', 1)->get(); // Gunakan get() agar hasilnya koleksi (array)
        // return view('user', ['data' => $user]);    }

        // $users = UserModel::where('level_id', 1)->get(); // Ambil semua data dengan level_id = 1
        // return view('user', ['data' => $users]); 
        
        $user = UserModel::findOr(20, ['user_id', 'username', 'nama', 'level_id'], function () {
            abort(404);
        });
        
        return view('user', ['data' => [$user]]);
    }
}