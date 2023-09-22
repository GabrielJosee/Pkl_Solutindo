@extends('adminlte::page')

@section('title', 'Tanggapan')    
@section('js')
@stop

@section('content_header')
    

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('pemindahan-gudang') }}">Daftar Pemindahan Barang Gudang</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pemindahan Barang Gudang</li>
    </ol>
</nav>


@stop

@section('content')

<h3 class="page-title">
    Form Detail Pemindahan Barang Gudang
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
            Detail Pemindahan Barang Gudang
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('pemindahan-gudang') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form>
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Pemindahan Gudang ID</a>
                        <input class="form-control input-bb" type="number" name="pengeluaran_gudang_id" id="pengeluaran_gudang_id" value="{{$pemindahan_gudang['warehouse_transfer_id']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Gudang Asal</a>
                        <input class="form-control input-bb" type="text" name="warehouse_id" id="warehouse_id" value="{{$pemindahan_gudang->callGudang['warehouse_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Produk</a>
                        <input class="form-control input-bb" type="text" name="product_id" id="product_id" value="{{$pemindahan_gudang->callProduct['product_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jumlah</a>
                        <input class="form-control input-bb" type="number" name="jumlah" id="jumlah" value="{{$pemindahan_gudang['required_amount']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Gudang Tujuan</a>
                        <input class="form-control input-bb" type="text" name="keterangan" id="keterangan" value="{{$pemindahan_gudang['destination_warehouse']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
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