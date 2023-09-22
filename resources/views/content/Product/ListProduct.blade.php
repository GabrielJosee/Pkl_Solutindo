@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Produk</b> <small>Mengelola Produk</small>
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
                <button onclick="location.href='{{ url('product/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Produk Baru</button>
                <button onclick="location.href='{{ url('/cetak-product') }}'" class="btn btn-sm btn-info" title="Add Data"
                    style="margin-left: 5px">Print PDF
                </button>
                <button onclick="location.href='{{ url('/cetak-product-excel') }}'" class="btn btn-sm btn-info"
                    title="Add Data" style="margin-left: 5px">Print Excel
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
                            <th style='text-align:center'>Kategori Produk</th>
                            <th style='text-align:center'>Nama Produk</th>
                            <th style='text-align:center'>Stok</th>
                            <th style='text-align:center'>Harga Produk</th>
                            <th style='text-align:center'>Expired</th>
                            <th style='text-align:center'>Deskripsi Produk</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($product as $prod)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style='text-align:center' width='10%'>
                                    {{ $prod->productCategory['product_category_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $prod['product_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $prod['product_stock'] }}</td>
                                <td style='text-align:center 'width='10%'>
                                    Rp{{ str_replace(',', '.', number_format($prod['product_price'])) }},00</td>
                                <td style='text-align:center 'width='10%'>{{ $prod['expired_time'] }} hari</td>
                                <td style='text-align:center' width='30%'>{{ $prod['product_description'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/product/edit/' . $prod['product_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/product/detail/' . $prod['product_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/product/hapus/' . $prod['product_id']) }}">Hapus</a>
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
