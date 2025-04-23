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
<!-- Tambahkan CSS DataTables jika belum -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush 
 
@push('js') 
<!-- Tambahkan jQuery & DataTables jika belum -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- CSRF Token Setup -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script> 
    $(document).ready(function() { 
        var dataUser = $('#table_user').DataTable({ 
            processing: true,
            serverSide: true,      
            ajax: { 
                url: "{{ url('user/list') }}", 
                type: "POST", 
                dataType: "json"
            }, 
            columns: [ 
                {
                    data: "DT_RowIndex",             
                    className: "text-center", 
                    orderable: false, 
                    searchable: false     
                },
                { 
                    data: "username",                
                    className: "", 
                    orderable: true,     
                    searchable: true     
                },
                { 
                    data: "nama",                
                    className: "", 
                    orderable: true,     
                    searchable: true     
                },
                { 
                    data: "level.level_nama",                
                    className: "", 
                    orderable: false,     
                    searchable: false     
                },
                { 
                    data: "aksi",                
                    className: "", 
                    orderable: false,     
                    searchable: false     
                } 
            ] 
        }); 
    }); 
</script> 
@endpush
