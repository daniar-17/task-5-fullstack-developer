@extends('main')

@section('title', 'Article')

@section('header_content')

  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Tambah Article</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Article</li>
              </ol>
          </div>
      </div>
  </div>
        
@endsection

@section('content')
    
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Article</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('articles/addProcess')}}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah Data Akan Disimpan ? ')">
                        @csrf
                        <div class="row">  
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="row">
                                    {{-- Baigan Kiri - Start --}}
                                    <div class="col-6 border-right">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                </div>
                                                <input type="text" name="title" class="form-control title @error('title') is-invalid @enderror" value="{{ old('title') }}" autofocus>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="category_id" id="category_id" class="form-control category_id">
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->id}}" data-user_id="{{$item->user_id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Id Category</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" name="user_id" class="form-control user_id @error('user_id') is-invalid @enderror" value="{{ old('user_id') }}" readonly>
                                                @error('user_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr style="border: 1px solid;" class="text-secondary">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-control btn btn-info">
                                                    <input accept="image/*" type="file" class="form-control" name="image" id="daftar_foto" style="display: none;"> Pilih Foto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ url('articles') }}" class="btn btn-sm btn-danger btn-block">
                                                    <i class="fas fa-reply"></i> Kembali
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" name="action" value="save_a" class="btn btn-sm btn-success btn-block"><i class="fa fa-save"></i> Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Baigan Kiri - End --}}

                                    {{-- Baigan Kanan - Start --}}
                                    <div class="col-6 border-left">
                                        <div class="form-group">
                                            <label for="">Image</label>
                                            <p>
                                                <img src="{{asset('/img/news/img01.jpg')}}" class="img img-rounded" id="upload_target" width="100%" style="border: 1px solid #555;" >
                                            </p>
                                        </div>
                                        
                                    </div>
                                    {{-- Baigan Kanan - End --}}
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea id="content" name="content" class="form-control" value="" rows="2" placeholder="Content . . ." required>{{ old('content') }}</textarea>
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
  </div>
    
@endsection

@section('jscript')

<script>
    $(function () {
        $(document).on("click", ".category_id", function () {
            var gnama = $('option:selected', this).attr('data-user_id');
            $('.user_id').val(gnama);
        });

        daftar_foto.onchange = evt => {
            const [file] = daftar_foto.files
            if (file) {
                upload_target.src = URL.createObjectURL(file)
            }
        }

        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('posts.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        })
    });
</script>

@endsection