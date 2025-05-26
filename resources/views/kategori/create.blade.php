@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ url('kategori') }}" class="form-horizontal">
                @csrf

                <div class="form-group row">
                    <label for="kategori_kode" class="col-2 control-label col-form-label">Kode Kategori</label>
                    <div class="col-10">
                        <input type="text" class="form-control @error('kategori_kode') is-invalid @enderror" 
                               name="kategori_kode" id="kategori_kode" 
                               value="{{ old('kategori_kode') }}" 
                               placeholder="Masukkan kode kategori" required>
                        @error('kategori_kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kategori_nama" class="col-2 control-label col-form-label">Nama Kategori</label>
                    <div class="col-10">
                        <input type="text" class="form-control @error('kategori_nama') is-invalid @enderror" 
                               id="kategori_nama" name="kategori_nama" 
                               value="{{ old('kategori_nama') }}" 
                               placeholder="Masukkan nama kategori" required>
                        @error('kategori_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a class="btn btn-secondary btn-sm ml-2" href="{{ url('kategori') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush