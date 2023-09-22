@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Produk</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Produk 
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
            Form Tambah
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('product') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form method="" action="/product/tambah/process" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nama Produk<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="product_name" id="product_name" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Harga<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="number" name="product_price" id="product_price" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <a class="text-dark">Kategori Produk<a class='red'> *</a></a>
                    <select class="selection-search-clear" name="product_category_id" id="product_category_id" style="width: 100% !important">
                        @foreach($ProductCategory as $PC)
                        <option value="{{$PC->product_category_id}}">{{$PC->product_category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Expired Time</a>
                        <input class="form-control input-bb" type="number" name="expired_time" id="expired_time" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi Produk</a>
                        <textarea rows="5" cols="" rows="" class="form-control input-bb" name="product_description" id="product_description"></textarea>
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



