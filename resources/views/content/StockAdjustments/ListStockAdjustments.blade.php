@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Penyesuaian Stock</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Penyesuaian Stock</b> <small>Mengelola System Penyesuaian Stock </small>
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
                <button onclick="location.href='{{ url('stock-adjustments/tambah') }}'" name="" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Penyesuaian Stock Baru</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Produk</th>
                            <th style='text-align:center'>Jumlah Awal</th>
                            <th style='text-align:center'>Jumlah Penyesuaian</th>
                            <th style='text-align:center'>Selisih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($stock_adjustments as $sa)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style='text-align:center' width='25%'>{{ $sa->callProduct['product_name'] }}
                                </td>
                                <td style='text-align:center' width='15%'>{{ $sa['initial_amount'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $sa['adjustment_amount'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $sa['difference'] }}</td>
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














{{-- 


    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
    </div>
</div>
<div class="card-body">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-hover table-full-width">
                <thead>
                    <tr>
                        <th style='text-align:center'>ID</th>
                        <th style='text-align:center'>Nama</th>
                        <th style='text-align:center'>Alamat</th>
                        <th style='text-align:center'>Tanggal Pendaftaran</th>
                        <th style='text-align:center'>Jenis Kelamin</th>
                        <th style='text-align:center'>Umur</th>
                        <th style='text-align:center'>No Hp</th>
                        <th style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $cust)
                        @if ($cust['data_state'] == 0)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $cust['customer_id'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $cust['customer_name'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $cust['customer_address'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $cust['customer_register_date'] }}
                                </td>
                                @if ($cust['customer_gender'] == 1)
                                    <td style='text-align:center' width='15%'>Laki - Laki</td>
                                @elseif ($cust['customer_gender'] == 2)
                                    <td style='text-align:center' width='15%'>Perempuan</td>
                                @endif
                                <td style='text-align:center' width='5%'>{{ $cust['customer_age'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $cust['customer_phone'] }}</td>
                                <td style='text-align:center' width='20%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/customer/edit/' . $cust['customer_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/customer/detail/' . $cust['customer_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/customer/hapus/' . $cust['customer_id']) }}">Hapus</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{ $customer->links() }}
        </div>
    </div>
</div>
@endsection --}}
