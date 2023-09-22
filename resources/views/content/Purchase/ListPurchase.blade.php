@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Pembelian</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Pembelian</b> <small>Mengelola System Pembelian </small>
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
                <button onclick="location.href='{{ url('purchase/tambah') }}'" name="" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Pembelian Baru</button>
                <button onclick="location.href='{{ url('/purchase/cetak-pdf') }}'" class="btn btn-sm btn-info"
                    title="Add Data" style="margin-left: 5px">Print PDF
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Pemasok</th>
                            <th style='text-align:center'>Produk</th>
                            <th style='text-align:center'>Jumlah Beli</th>
                            <th style='text-align:center'>Harga</th>
                            <th style='text-align:center'>Diskon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($purchase as $purchases)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style='text-align:center' width='25%'>{{ $purchases['supplier_name'] }}</td>
                                <td style='text-align:center' width='25%'>{{ $purchases->callProduct['product_name'] }}
                                </td>
                                <td style='text-align:center' width='15%'>{{ $purchases['purchase_amount'] }}</td>
                                <td style='text-align:center' width='15%'>Rp
                                    {{ number_format($purchases['purchase_price']) }},00</td>
                                <td style='text-align:center' width='15%'>
                                    @if ($purchases['purchase_discount'] == 0.0)
                                        -
                                    @else
                                        {{ $purchases['purchase_discount'] * 100 }}%
                                    @endif
                                </td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
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
