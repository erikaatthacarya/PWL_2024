@extends('layouts.app') {{-- jika menggunakan AdminLTE --}}

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Profil</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="profile_picture">Foto Profil</label>
                <div class="mb-2">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/profile_pictures/'.$user->profile_picture) }}" width="150" class="img-circle elevation-2">
                    @else
                        <small class="text-muted">Belum ada foto</small>
                    @endif
                </div>
                <input type="file" name="profile_picture" class="form-control">
                <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</small>
                @error('profile_picture') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
