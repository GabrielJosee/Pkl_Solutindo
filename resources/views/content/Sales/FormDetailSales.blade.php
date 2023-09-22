@extends('adminlte::page')

@section('title', 'Tanggapan')
@section('js')
@stop

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('item') }}">Daftar Penjualan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Penjualan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Detail Penjualan
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
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Detail Penjualan
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('sales') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form>
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">No Penjualan</a>
                            <input class="form-control input-bb" type="text" name="sales_no" id="sales_no"
                                value="{{ $sales['sales_no'] }}" autocomplete="off" readonly />

                            <input class="form-control input-bb" type="hidden" name="sales_id" id="sales_id"
                                value="{{ $sales['sales_id'] }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Seller</a>
                            <input class="form-control input-bb" type="text" name="seller_name" id="seller_name"
                                value="{{ $sales['seller_name'] }}" autocomplete="off" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Buyer</a>
                            <input class="form-control input-bb" type="text" name="buyer_name" id="buyer_name"
                                value="{{ $sales['buyer_name'] }}" autocomplete="off" readonly />
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Metode Pembayaran</a>
                            <input class="form-control input-bb" type="text" name="payment_name" id="payment_name"
                                value="{{ $sales['payment_name'] }}" autocomplete="off" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Batas Tgl Pembayaran</a>
                            <input class="form-control input-bb" type="text" name="payment_due_date"
                                id="payment_due_date" value="{{ $sales['payment_due_date'] }}" autocomplete="off"
                                readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tgl Pembayaran</a>
                            <input class="form-control input-bb" type="text" name="payment_date" id="payment_date"
                                value="{{ $sales['payment_date'] }}" autocomplete="off" readonly />
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Status Pembayaran</a>
                            <input class="form-control input-bb" type="text" name="sales_status" id="sales_status"
                                value="{{ $salesstatus[$sales['sales_status']] }}" autocomplete="off" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Total Harga</a>
                            <input class="form-control input-bb" type="text" name="sales_price" id="sales_price"
                                value="{{ number_format($sales['sales_price']) }}" autocomplete="off" readonly />
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </form>

    <form>
        @csrf
        <div class="card border border-dark">
            <div class="card-header border-dark bg-dark">
                <h5 class="mb-0 float-left">
                    List Item
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th width="5%" style='text-align:center'>No</th>
                                <th width="20%" style='text-align:center'>Nama Item</th>
                                <th width="20%" style='text-align:center'>Variant</th>
                                <th width="10%" style='text-align:center'>Harga Satuan</th>
                                <th width="10%" style='text-align:center'>Kuantitas</th>
                                <th width="10%" style='text-align:center'>Harga</th>
                                <th width="25%" style='text-align:center'>Kebutuhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                        if(count($salesitem)!=0){
                        $no = 1; 
                        ?>
                            @foreach ($salesitem as $item)
                                <tr>
                                    <td align="center">{{ $no }}</td>
                                    <td align="left">{{ $item['item_name'] }}</td>
                                    <td align="left">{{ $Sales->getItemVariantName($item['item_variant_id']) }}</td>
                                    <td align="right">{{ number_format($item['sales_item_unit_price']) }}</td>
                                    <td align="right">{{ number_format($item['sales_item_quantity']) }}</td>
                                    <td align="right">{{ number_format($item['sales_item_price']) }}</td>
                                    <td align="left">{{ $item['sales_item_requirement'] }}</td>
                                </tr>
                                <?php $no++; ?>
                            @endforeach
                            <?php }else{?>
                            <tr>
                                <td align="center" colspan="7">Data Kosong</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

@stop

@section('footer')

@stop

@section('css')

@stop
