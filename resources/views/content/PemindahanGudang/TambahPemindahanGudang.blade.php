@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    @if ($productStockSelect == null)

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/pemindahan-gudang') }}">Daftar Pemindahan Barang Gudang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pemindahan Barang Gudang</li>
            </ol>
        </nav>


    @stop

    @section('content')

        <h3 class="page-title">
            Form Tambah Pemindahan Barang Gudang
        </h3>
        <br />
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card border border-dark">
            <div class="card-header border-dark bg-dark">
                <h5 class="mb-0 float-left">
                    Form Cari
                </h5>
                <div class="float-right">
                    <button onclick="location.href='{{ url('/pemindahan-gudang/kembali_pg') }}'" name="Find"
                        class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
                </div>
            </div>
            <form method="" action="/pemindahan-gudang/tambah/search" enctype="multipart/form-data">
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
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
                        <button type="submit" name="Save" class="btn btn-primary" title="Save"><i
                                class="fa fa-search"></i>
                            Cari</button>
                    </div>
                </div>
        </div>
        </div>
        </form>
        <div class="card border border-dark">
            <div class="card-header bg-dark clearfix">
                <h5 class="mb-0 float-left">
                    Daftar Produk Stok
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" style="width:100%"
                        class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th style='text-align:center'>No</th>
                                <th style='text-align:center'>Nama Gudang</th>
                                <th style='text-align:center'>Nama Produk</th>
                                <th style='text-align:center'>Nomor Pembelian</th>
                                <th style='text-align:center'>Stok Barang</th>
                                <th style='text-align:center'>Lama Kadaluarsa</th>
                                <th style='text-align:center'>Tanggal Kadaluarsa</th>
                                <th style='text-align:center'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($product_stock as $product_stocks)
                                <tr>
                                    <td style='text-align:center' width='5%'>{{ $no }}</td>
                                    <td style='text-align:center' width='13%'>
                                        {{ $product_stocks->callGudang['warehouse_name'] }}</td>
                                    <td style='text-align:center' width='13%'>
                                        {{ $product_stocks->callProduct['product_name'] }}</td>
                                    <td style='text-align:center' width='14%'>{{ $product_stocks['purchase_no'] }}</td>
                                    <td style='text-align:center' width='12%'>{{ $product_stocks['stock'] }}</td>
                                    <td style='text-align:center' width='13%'>{{ $product_stocks['expired_time'] }} hari
                                    </td>
                                    <td style='text-align:center' width='15%'>{{ $product_stocks['expired_date'] }}</td>
                                    <td style='text-align:center' width='5%'>
                                        <a type="button" class="btn btn-outline-info btn-sm"
                                            href="{{ url('/pemindahan-gudang/tambah/pindah/' . $product_stocks['product_stock_id']) }}">Pindah</a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/pemindahan-gudang/tambah/kembali_pgtambah') }}">Daftar Pemindahan Barang
                        Gudang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pemindahan Barang Gudang</li>
            </ol>
        </nav>


    @stop

    @section('content')

        <h3 class="page-title">
            Form Tambah Pemindahan Barang Gudang
        </h3>
        <br />
        @if (session('error'))
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
                    <button onclick="location.href='{{ url('pemindahan-gudang/tambah/kembali_pgtambah') }}'" name="Find"
                        class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
                </div>
            </div>
            <form method="" action="/pemindahan-gudang/tambah/process" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Gudang Asal<a class='red'> *</a></a>
                                <input class="form-control" type="text" name="warehouse_id" id="warehouse_id"
                                    value="{{ $productStockSelect->callGudang['warehouse_name'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Produk<a class='red'> *</a></a>
                                <input class="form-control" type="text" name="product_id" id="product_id"
                                    value="{{ $productStockSelect->callProduct['product_name'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Jumlah<a class='red'> *</a></a>
                                <input class="form-control" type="number" name="required_amount"
                                    id="required_amount" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Gudang Tujuan<a class='red'> *</a></a>
                                {!! Form::select('destination_warehouse', $gudang, null, [
                                    'class' => 'selection-search-clear select-form',
                                    'id' => 'destination_warehouse',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger"
                            onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" name="Save" class="btn btn-primary" title="Save"><i
                                class="fa fa-check"></i>
                            Simpan</button>
                    </div>
                </div>
        </div>
        </div>
        </form>
    @endif

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
