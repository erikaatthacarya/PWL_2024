<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user,
            'activeMenu' => 'profile',
            'breadcrumb' => (object) [
                'title' => 'Edit Profil',
                'list' => ['Home', 'Profil', 'Edit']
            ]
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                // Hapus gambar lama jika ada
                if ($user->profile_picture && Storage::exists('public/profile_pictures/'.$user->profile_picture)) {
                    Storage::delete('public/profile_pictures/'.$user->profile_picture);
                }

                // Proses upload baru
                $image = $request->file('profile_picture');
                $filename = 'profile_'.$user->id.'_'.time().'.'.$image->getClientOriginalExtension();

                // Resize dan simpan ke storage
                $img = Image::make($image->getRealPath());                
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/public/profile_pictures/' . $filename));

                // Update ke database
                $user->profile_picture = $filename;
                $user->save();

                return back()
                    ->with('success', 'Foto profil berhasil diperbarui!')
                    ->with('reload', true);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupload gambar: '.$e->getMessage());
        }
    }
}
