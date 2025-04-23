<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Models\LevelModel;
use PhpParser\Node\Expr\Cast\Object_;

class UserController extends Controller
{
    // menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list'  => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        return view('user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
    

    // ambil data user dalam bentuk JSON untuk datatables
    
    public function list()
    {
        $data = UserModel::with('level')->select('m_user.*');
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $show = url('/user/' . $row->user_id);
                $edit = url('/user/' . $row->user_id . '/edit');
                $delete = url('/user/' . $row->user_id);
    
                return '
                    <a href="' . $show . '" class="btn btn-sm btn-info">Detail</a>
                    <a href="' . $edit . '" class="btn btn-sm btn-warning">Edit</a>
                    <form action="' . $delete . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin dihapus?\')">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
            //menampilkan halaman form tambah user
    public function create()
    {
    $breadcrumb = (object) [
    'title' => 'Tambah User',
    'list' => ['Home', 'User', 'Tambah']
    ];

    $page = (object) [
    'title' => 'Tambah user baru'
    ];
    $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
    $activeMenu = 'user'; // set menu yang sedang aktif

    return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
}
    // Menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
            
            // password harus diisi dan minimal 5 karakter
            // level_id harus diisi dan berupa angka
        ]);
        UserModel :: create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
            'level_id' => $request->level_id
            ]);
            
            return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }
    //menampilkan detaik user 
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);
        $breadcrumb = (Object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail user'
        ];
        $activeMenu = 'user';//set menu yang sedang aktif
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    //menampilkan halaman form edit user 
    public function edit(string $id)
    {
        $user = UserModel::find($id);
    $level = LevelModel::all();

    $breadcrumb = (object) [
        'title' => 'Edit User',
        'list' => ['Home', 'User', 'Edit']
    ];

    $page = (object) [
        'title' => 'Edit user'
    ];

    $activeMenu = 'user'; // set menu yang sedang aktif

    return view('user.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'user' => $user,
        'level' => $level,
        'activeMenu' => $activeMenu
    ]);
}
// Menyimpan perubahan data user
// app/Http/Controllers/UserController.php

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'username' => 'required|unique:m_user,username,' . $id . ',user_id',
        'nama'     => 'required',
        'level_id' => 'required'
    ]);

    $user = UserModel::find($id); // ← Bagian ini
    $password = $request->password ? bcrypt($request->password) : $user->password;

    $user->update([
        'username' => $request->username,
        'nama' => $request->nama,
        'password' => $password,
        'level_id' => $request->level_id
    ]);

    return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
}
//menghapus data user
public function destroy(string $id)
{
    $check = UserModel::find($id);
    if (!$check) {  // Mengecek apakah data user dengan ID yang dimaksud ada atau tidak
        return redirect('/user')->with('error', 'Data user tidak ditemukan');
    }

    try {
        UserModel::destroy($id);  // Hapus data user dari database

        return redirect('/user')->with('success', 'Data user berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan pesan error
        return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}

}