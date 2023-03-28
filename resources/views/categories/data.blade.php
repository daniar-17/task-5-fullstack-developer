@extends('main')

@section('title', 'Category')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Data Category</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">

    <div class="card card-default">
        
        <div class="card-header">
            <a href="{{ url('categories/add') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table2" class="table table-striped">
                <thead>
                    <tr class="font-weight-bold">
                        <td>#</td>
                        <td>Id Category</td>
                        <td>Nama Category</td>
                        <td style="width: 10%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$item->user_id}}</td>
                        <td class="dots-text">{{$item->name}}</td>
                        <td class="text-center">
                            <a href="{{ url('categories/edit/' .$item->id ) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a> |
                            <form action="{{ url('categories/delete/' .$item->id ) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data dengan Category <?=$item->name?> ? ')">
                                @csrf
                                <button class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>

@endsection

@section('jscript')

<script>
    $(function () {
      $("#bootstrap-data-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["excel", "pdf"]
      }).buttons().container().appendTo('#bootstrap-data-table_wrapper .col-md-6:eq(0)');

      $("#bootstrap-data-table2").DataTable();
    });

</script>

@if (session('status'))
    <script>
        toastr.success("{{ session('status') }}")
    </script>
@endif

@endsection