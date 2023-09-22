@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('productcategory') }}">Daftar Produk Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Produk Kategori</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Detail Produk Kategori
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
    <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Detail
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('productcategory') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form method="post" action="/system-user/process-edit-system-user" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID Produk Kategori</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $ProductCategory['product_category_id'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Kode Produk Kategori</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $ProductCategory['product_category_code'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Produk Kategori</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $ProductCategory['product_category_name'] }}" readonly/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop

@section('js')
    
@stop