@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('sales') }}">Daftar Penjualan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Penjualan</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Detail Penjualan
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
    <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Detail
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('sales') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID Penjualan</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales['sales_id'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No Penjualan</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales['sales_no'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID Pelanggan</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales['customer_id'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Pelanggan</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales->callCustomer['customer_name'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Penjualan</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales['sales_date'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Keterangan Penjualan</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales['sales_remark'] }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID Item Penjualan</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" 
                        @if ($sales_item)
                            value="{{ $sales_item['sales_item_id'] }}"
                        @else
                            value=""
                        @endif
                        readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID Produk</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales_item['product_id'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Produk</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales_item->callProduct['product_name'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Harga Produk</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="Rp{{ str_replace(',', '.', (number_format($sales_item['sales_item_price']))) }},00" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Banyak Produk</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales_item['sales_item_amount'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Total Produk</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="Rp{{ str_replace(',', '.', (number_format($sales_item['sales_item_total_price']))) }},00" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID Gudang</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales_item['warehouse_id'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Gudang</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales_item->callGudang['warehouse_name'] }}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Sales Parent ID</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{ $sales['sales_parent_id'] }}" readonly/>
                    </div>
                </div>
            </div>
        </div>
    </form>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop

@section('js')
    
@stop