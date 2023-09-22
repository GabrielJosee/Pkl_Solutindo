@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Produk</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Produk
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
            <button onclick="location.href='{{ url('product') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form action="{{ url('/product/edit/process/' . $product['product_id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Produk<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="product_name" id="name" value="{{ $product['product_name'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Harga<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="product_price" id="name" value="{{ $product['product_price'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Kategori Produk<a class='red'> *</a></a>
                        <select class="form-control" aria-label="Default select example" name="product_category_id">
                            @foreach ($ProductCategory as $PC)
                                <option value="{{ $PC['product_category_id'] }}">{{ $PC['product_category_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi Produk<a class='red'> *</a></a>
                        <textarea name="product_description" id="product_description" cols="20" rows="5" class="form-control input-bb">{{ $product->product_description }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Expired Time<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="number" name="expired_time" id="expired_time" value="{{ $product['expired_time'] }}"/>
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