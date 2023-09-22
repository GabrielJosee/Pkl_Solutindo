@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Pengeluaran Gudang</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Pengeluaran Gudang</b> <small>Mengelola Pengeluaran Gudang</small>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session('message') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('/pengeluaran-gudang/tambah') }}'" name="Find"
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Pengeluaran Gudang
                    Baru</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Gudang Asal</th>
                            <th style='text-align:center'>Produk</th>
                            <th style='text-align:center'>Jumlah</th>
                            <th style='text-align:center'>Keterangan</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($pengeluaran_gudang as $pg)
                            <tr>
                                <td style='text-align:center' width='10%'>{{ $no }}</td>
                                <td style='text-align:center' width='20%'>{{ $pg->callGudang['warehouse_name'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $pg->callProduct['product_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $pg['jumlah'] }}</td>
                                <td style='text-align:center' width='25%'>{{ $pg['keterangan'] }}</td>
                                <td style='text-align:center' width='15a%'>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/pengeluaran-gudang/detail/' . $pg['pengeluaran_gudang_id']) }}">Detail</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
