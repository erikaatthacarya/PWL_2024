@extends('layouts.template') 

@section('content') 
<div class="card card-outline card-primary"> 
    <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
        <div class="card-tools"> 
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a> 
            <button onclick="modalAction('{{ url('user/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
        </div> 
    </div> 
    <div class="card-body"> 
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Filter --}}
        <div class="row mb-3">
            <label class="col-1 control-label col-form-label">Filter:</label>
            <div class="col-3">
                <select class="form-control" id="level_id" name="level_id">
                    <option value="">- Semua -</option>
                    @foreach ($level as $item)
                        <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Level Pengguna</small>
            </div>
        </div>

        {{-- Table --}}
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user"> 
            <thead> 
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr> 
            </thead> 
        </table> 
    </div> 
</div> 
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div> 
@endsection 

@push('css') 
<!-- CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush 

@push('js') 
<button onclick="modalAction('{{ url('user/create_ajax') }}')" ...>
function modalAction(url) {
    $.get(url, function(result) {
        $('#myModal').html(result).modal('show');
    }).fail(function(xhr) {
        alert('Gagal mengambil data. Cek kembali URL dan koneksi.');
    });
}
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- CSRF Token -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- DataTables Script -->
<script>
    $(document).ready(function() {
        var dataUser = $('#table_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('user/list') }}",
                type: "POST",
                data: function(d) {
                    d.level_id = $('#level_id').val();
                }
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "username", name: "username" },
                { data: "nama", name: "nama" },
                { data: "level_nama", name: "level_nama", orderable: false, searchable: false },
                { data: "aksi", name: "aksi", orderable: false, searchable: false }
            ]
        });

        $('#level_id').on('change', function() {
            dataUser.ajax.reload();
        });

        // CSRF Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endpush
