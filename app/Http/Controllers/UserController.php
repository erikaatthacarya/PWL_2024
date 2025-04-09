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
        
        // $user = UserModel::findOr(20, ['user_id', 'username', 'nama', 'level_id'], function () {
        //     abort(404);
        // });
        
        // return view('user', ['data' => [$user]]);

        // $user = UserModel::findOrFail(1);
        // return view('user', ['data' => [$user]]); // Bungkus dalam array

        // $user = UserModel::where('ausername', 'manager_tiga')->get(); // Gunakan get() agar jadi collection
        // return view('user', ['data' => $user]);

        // Ambil semua data pengguna
        // $data = UserModel::all();

        // // Hitung jumlah pengguna
        // $jumlahPengguna = $data->count();

        // // Kirim data dan jumlah pengguna ke view
        // return view('user', ['data' => $data, 'jumlahPengguna' => $jumlahPengguna]);
        
        // $user = UserModel::where('level_id', 2)->count();
        // return view('user', ['jumlahPengguna' => $user]);
         
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );

        // return view('user', ['data' => [$user]]); // bungkus dalam array

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // return view('user', ['data' => [$user]]); // bungkus dalam array

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );

        // return view('user', ['data' => [$user]]); // bungkus dalam array

        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ],
        );
        $user->save();

        return view('user', ['data' => [$user]]); // bungkus dalam array

    }
}