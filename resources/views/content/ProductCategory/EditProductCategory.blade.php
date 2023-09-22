@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('productcategory') }}">Daftar Produk Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Produk Kategori</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Produk Kategori
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
            Form Edit
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('productcategory') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form action="{{ url('/productcategory/edit/process/' . $ProductCategory['product_category_id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Kode Produk Kategori<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="product_category_code" id="name" value="{{ $ProductCategory['product_category_code'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Produk Kategori<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="product_category_name" id="name" value="{{ $ProductCategory['product_category_name'] }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
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