@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Voucher</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Voucher</b> <small>Mengelola Voucher</small>
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
                <button onclick="location.href='{{ url('/vouchers/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Voucher Baru</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Nama voucher</th>
                            <th style='text-align:center'>Tanggal Awal</th>
                            <th style='text-align:center'>Tanggal Akhir</th>
                            <th style='text-align:center'>Nominal</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($voucher as $vcr)
                            <tr>
                                <td style='text-align:center' width='10%'>{{ $no }}</td>
                                <td style='text-align:center' width='20%'>{{ $vcr['vouchers_name'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $vcr['start_date'] }}</td>
                                <td style='text-align:center' width='25%'>{{ $vcr['end_date'] }}</td>
                                <td style='text-align:center' width='15%'>{{ "Rp". number_format($vcr['nominal'], 2,',','.') }}
                                </td>
                                <td style='text-align:center' width='10%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/vouchers/edit/' . $vcr['vouchers_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/vouchers/hapus/' . $vcr['vouchers_id']) }}">Hapus</a>
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
