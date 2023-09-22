@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Pembelian per Periode</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Laporan Pembelian per Periode</b> <small>Mengelola Pembelian per Periode</small>
    </h3>
    <br />
    <div id="accordion">
        <form method="post" action="{{ route('filter-laporan-pembelian-per-periode') }}" enctype="multipart/form-data">
            @csrf
            <div class="card border border-dark">
                <div class="card-header bg-dark" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <h5 class="mb-0">
                        Filter
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <section class="control-label">Tanggal Mulai
                                        <span class="required text-danger">
                                            *
                                        </span>
                                    </section>
                                    <input type="date"
                                        class="form-control form-control-inline input-medium date-picker input-date"
                                        data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date"
                                        onChange="function_elements_add(this.name, this.value);" value="{{ $start_date }}"
                                        style="width: 15rem;" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <section class="control-label">Tanggal Akhir
                                        <span class="required text-danger">
                                            *
                                        </span>
                                    </section>
                                    <input type="date"
                                        class="form-control form-control-inline input-medium date-picker input-date"
                                        data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date"
                                        onChange="function_elements_add(this.name, this.value);" value="{{ $end_date }}"
                                        style="width: 15rem;" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="form-actions float-right">
                            <button type="reset" name="Reset" class="btn btn-danger"
                                onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                            <button type="submit" name="Find" class="btn btn-primary" title="Search Data"><i
                                    class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Laporan
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('/laporan-pembelian-per-periode/cetak-pdf') }}'" class="btn btn-sm btn-info"
                    title="Add Data" style="margin-left: 5px">Print PDF
                </button>
                <button onclick="location.href='{{ url('/laporan-pembelian-per-periode/cetak-excel') }}'" class="btn btn-sm btn-info"
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
                            <th style='text-align:center'>Pemasok</th>
                            <th style='text-align:center'>Produk</th>
                            <th style='text-align:center'>Jumlah Beli</th>
                            <th style='text-align:center'>Diskon</th>
                            <th style='text-align:center'>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($purchase as $purchases)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}</td>
                                <td style='text-align:left' width='20%'>{{ $purchases['supplier_name'] }}</td>
                                <td style='text-align:left' width='25%'>{{ $purchases->callProduct['product_name'] }}
                                </td>
                                <td style='text-align:center' width='15%'>{{ $purchases['purchase_amount'] }}</td>
                                <td style='text-align:center' width='10%'>
                                    @if ($purchases['purchase_discount'] == 0.0)
                                        -
                                    @else
                                        {{ $purchases['purchase_discount'] * 100 }}%
                                    @endif
                                </td>
                                <td width="25%" style='text-align:right'>Rp. {{str_replace(',', '.', (number_format($purchases['purchase_price'])))}},00</td>
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
