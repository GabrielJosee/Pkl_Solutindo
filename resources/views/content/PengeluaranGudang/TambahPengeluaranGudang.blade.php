@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pengeluaran-gudang') }}">Daftar Pengeluaran Gudang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Pengeluaran Gudang</li>
        </ol>
    </nav>


@stop

@section('content')

    <h3 class="page-title">
        Form Tambah Pengeluaran Gudang
    </h3>
    <br />
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Tambah
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('pengeluaran-gudang') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="" action="/pengeluaran-gudang/tambah/process" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Gudang Asal<a class='red'> *</a></a>
                            {!! Form::select('warehouse_id', $gudang, null, [
                                'class' => 'selection-search-clear select-form',
                                'id' => 'warehouse_id',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Produk<a class='red'> *</a></a>
                            {!! Form::select('product_id', $product, null, [
                                'class' => 'selection-search-clear select-form',
                                'id' => 'product_id',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a class="text-dark">Jumlah<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="number" name="jumlah" id="jumlah" value="" />
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Keterangan<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="keterangan" id="keterangan"
                                value="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                            class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i>
                        Simpan</button>
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
