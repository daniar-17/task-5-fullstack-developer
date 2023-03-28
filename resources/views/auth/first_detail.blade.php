@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="{{asset('db_image/' .$datas->image)}}" alt="Gambar" style="width:100%; height:300px;">
                <div class="row p-3">
                    <div class="col-md-6"><h6 class="font-weight-bold font-italic">{{ $datas->created_at }}</h6></div>
                    <div class="col-md-6"><h5 class="badge badge-pill badge-secondary float-right">{{ $datas->name }}</h5></div>
                </div>
                <div class="container p-3">
                    <h4><b>{{ $datas->title }}</b></h4>
                    <p class="dots-test">{!! html_entity_decode($datas->content) !!}</p>
                    <a href="{{ url('/') }}" class="btn btn-block btn-outline-secondary btn-sm"><i class="fas fa-arrow-circle-left"></i> <u>Kembali</u></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
