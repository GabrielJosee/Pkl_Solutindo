@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('productcategory') }}">Daftar Produk Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Produk Kategori</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Gudang
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
            <button onclick="location.href='{{ url('warehouse') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>
    <form method="" action="/warehouse/tambah/process" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nama Gudang<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="warehouse_name" id="warehouse_name"
                            value="" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Alamat<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="address" id="address"
                            value="" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nama Penanggung Jawab Gudang<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="warehouse_responsible_name" id="warehouse_responsible_name"
                            value="" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">No HP<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="number_phone" id="number_phone"
                            value="" />
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