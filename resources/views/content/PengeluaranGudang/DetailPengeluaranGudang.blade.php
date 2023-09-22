@extends('adminlte::page')

@section('title', 'Tanggapan')    
@section('js')
@stop

@section('content_header')
    

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('pengeluaran-gudang') }}">Daftar Pengeluaran Gudang</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pengeluaran Gudang</li>
    </ol>
</nav>


@stop

@section('content')

<h3 class="page-title">
    Form Detail Pengeluaran Gudang
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
            Detail Pengeluaran Gudang
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('pengeluaran-gudang') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form>
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Pengeluaran Gudang ID</a>
                        <input class="form-control input-bb" type="number" name="pengeluaran_gudang_id" id="pengeluaran_gudang_id" value="{{$pengeluaran_gudang['pengeluaran_gudang_id']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Gudang</a>
                        <input class="form-control input-bb" type="text" name="warehouse_id" id="warehouse_id" value="{{$pengeluaran_gudang->callGudang['warehouse_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Produk</a>
                        <input class="form-control input-bb" type="text" name="product_id" id="product_id" value="{{$pengeluaran_gudang->callProduct['product_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jumlah</a>
                        <input class="form-control input-bb" type="number" name="jumlah" id="jumlah" value="{{$pengeluaran_gudang['jumlah']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Keterangan</a>
                        <input class="form-control input-bb" type="text" name="keterangan" id="keterangan" value="{{$pengeluaran_gudang['keterangan']}}" autocomplete="off" readonly/>
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