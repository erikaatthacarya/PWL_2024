<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();

        // return view('user', ['data' => [$user]]); // bungkus dalam array

        // $user = UserModel::create(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->username = 'manager56';

        // $user->isDirty(); //true
        // $user->isDirty('username'); // true
        // $user->isDirty('nama'); // false
        // $user->isDirty(['nama', 'username']) ; // true

        // $user->isClean(); // false
        // $user->isClean('username'); // false
        // $user->isClean('nama'); // true
        // $user->isClean(['nama', 'username']) ; // false

        // $user->save() ;

        // $user->isDirty(); // false
        // $user->isClean(); // true
        // dd($user->isDirty());

        // $user = UserModel::create([
        //     'username' => 'manager11',
        //     'nama' => 'Manager11',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
            
        //     ]);
            
        //     $user->username = 'manager12';
            
        //     $user->save();
            
        //     $user->wasChanged(); // true
        //     $user->wasChanged('username'); // true
        //     $user->wasChanged(['username', 'level_id' ]) ; // true
        //     $user->wasChanged('nama'); // false
        //     $user->wasChanged(['nama', 'username' ]); // true

        $user = UserModel::all();
        return view('user', ['data' => $user]);

    }
    public function tambah()
    {
        return view('user_tambah');
    }
    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ]);
        return redirect('/user');
    }
    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }
    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

}