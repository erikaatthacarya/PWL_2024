@extends('layouts.template') 

@section('content') 
<div class="card card-outline card-primary"> 
    <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
        <div class="card-tools"> 
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a> 
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
@endsection 

@push('css') 
<!-- CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush 

@push('js') 
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
                dataType: "json",
                data: function (d){
                    d.level_id = $('#level_id').val();
                }
            },
            columns: [ 
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "username" },
                { data: "nama" },
                { data: "level_nama", orderable: false, searchable: false },
                { data: "aksi", orderable: false, searchable: false }
            ]
        }); 

        // reload tabel saat filter level diubah
        $('#level_id').on('change', function() {
            dataUser.ajax.reload();
        });
    });
</script> 
@endpush
