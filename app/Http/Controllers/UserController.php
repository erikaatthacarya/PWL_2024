<?php 
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //tambah data user dengan Eloquent Model
        $data = [
            'nama' => 'Pelanggan Pertama',
        ];
        UserModel::where('username', 'pelanggan1')->update($data);
        // UserModel::insert($data); //tambahkan data ke tabel m_user

        //coba akses model UserModel
        $user = UserModel::all(); //ambil semua data dari tabel m_user
        return view('m_user', ['data' => $user]); //mengirim data ke view user.blade.php
    }
}
?>