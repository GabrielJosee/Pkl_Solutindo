@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Penjualan per Produk</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Laporan Penjualan per Produk</b> <small>Mengelola Penjualan per Produk</small>
    </h3>
    <br/>
    <div id="accordion">
        <form method="post" action="{{route('filter-laporan-penjualan-per-produk')}}" enctype="multipart/form-data">
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
                            <div class="col-md-6">
                                <a class="text-dark">Produk</a>
                                <br/>
                                {!! Form::select('product_id',  $product, $product_id, ['class' => 'selection-search-clear select-form', 'id' => 'product_id']) !!}
                                {{-- {!! Form::select('user_group_id',  $systemusergroup, $user_id, ['class' => 'selection-search-clear select-form']) !!} --}}
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
                <button onclick="location.href='{{ url('/laporan-penjualan-per-produk/cetak-pdf') }}'" class="btn btn-sm btn-info"
                    title="Add Data" style="margin-left: 5px">Print PDF
                </button>
                <button onclick="location.href='{{ url('/laporan-penjualan-per-produk/cetak-excel') }}'" class="btn btn-sm btn-info"
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
                            <th style='text-align:center'>Nama Produk</th>
                            <th style='text-align:center'>Tanggal Penjualan</th>
                            <th style='text-align:center'>Jumlah Produk</th>
                            <th style='text-align:center'>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($sales_item as $si)
                            <tr>
                                <td width="5%" style='text-align:center'>{{ $no }}</td>
                                <td width="30%" >{{ $si->callProduct['product_name'] }}</td>
                                <td width="30%" style="text-align:center">
                                    @if(!is_null($si) && isset($si->callSalesTok['sales_date']))
                                        {{ $si->callSalesTok['sales_date'] }}
                                    @else
                                        null
                                    @endif
                                </td>
                                
                                <td width="10%" style='text-align:center'>{{$si['sales_item_amount']}}</td>
                                <td width="25%" style='text-align:right'>Rp{{str_replace(',', '.', (number_format($si['sales_item_total_price'])))}},00</td>
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
