@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Penjualan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Penjualan</b> <small>Mengelola Penjualan</small>
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
                <button onclick="location.href='{{ url('sales/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Penjualan Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Pelanggan</th>
                            <th style='text-align:center'>Tanggal Penjualan</th>
                            <th style='text-align:center'>Keterangan</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($sales as $sls)
                            <tr>
                                <td style='text-align:center' width='25%'>{{ $sls['sales_no'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $sls->callCustomer['customer_name'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $sls['sales_date'] }}</td>
                                <td style='text-align:center' width='25%'>{{ $sls['sales_remark'] }}</td>
                                <td style='text-align:center' width='10%'>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/sales/detail/' . $sls['sales_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/sales/invoice/' . $sls['sales_id']) }}">Invoice</a>
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
