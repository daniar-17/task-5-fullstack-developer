@extends('main')

@section('title', 'Category')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Tambah Category</h1>
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
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Tambah Category</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('categories/addProcess')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="">Id Category</label>
                            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id') }}" autofocus placeholder="Id Category . . .">
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Category</label>
                            <input type="text" name="name_category" class="form-control @error('name_category') is-invalid @enderror" value="{{ old('name_category') }}" autofocus placeholder="Nama Category . . .">
                            @error('name_category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ url('categories') }}" class="btn btn-danger">
                                    <i class="fa fa-reply"></i> Kembali
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-success" style="float: right;"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
      </div>
  </div>
    
@endsection