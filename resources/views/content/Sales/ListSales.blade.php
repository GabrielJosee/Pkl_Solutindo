@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('js')
<script>
	$(document).ready(function(){
        var seller_id               = {!! json_encode($seller_id) !!};
        
        if(seller_id == null){
            $("#seller_id").select2("val", "0");
        }
        
        var payment_id               = {!! json_encode($payment_id) !!};
        
        if(payment_id == null){
            $("#payment_id").select2("val", "0");
        }
        
        var sales_status               = {!! json_encode($sales_status) !!};
        
        if(sales_status == null){
            $("#sales_status").select2("val", "0");
        }
    });
</script>
@stop

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
<br/>
<div id="accordion">
    <form  method="post" action="{{route('filter-sales')}}" enctype="multipart/form-data">
    @csrf
        <div class="card border border-dark">
        <div class="card-header bg-dark" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5 class="mb-0">
                Filter
            </h5>
        </div>
    
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class = "row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Tanggal Mulai
                                <span class="required text-danger">
                                    *
                                </span>
                            </section>
                            <input type ="date" class="form-control form-control-inline input-medium date-picker input-date" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="{{$start_date}}" style="width: 15rem;"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <section class="control-label">Tanggal Akhir
                                <span class="required text-danger">
                                    *
                                </span>
                            </section>
                            <input type ="date" class="form-control form-control-inline input-medium date-picker input-date" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="{{$end_date}}" style="width: 15rem;"/>
                        </div>
                    </div>
                </div>
                <br/>
                <div class = "row">
                    <div class="col-md-6">
                        <a class="text-dark">Penjual</a>
                        <br/>
                        {!! Form::select('seller_id',  $seller, $seller_id, ['class' => 'selection-search-clear select-form', 'id' => 'seller_id']) !!}
                    </div>
                    <div class="col-md-6">
                        <a class="text-dark">Metode Pembayaran</a>
                        <br/>
                        {!! Form::select('payment_id',  $corepayment, $payment_id, ['class' => 'selection-search-clear select-form', 'id' => 'payment_id']) !!}
                    </div>
                </div>
                <br/>
                <div class = "row">
                    <div class="col-md-6">
                        <a class="text-dark">Status</a>
                        <br/>
                        {!! Form::select('sales_status',  $salesstatus, $sales_status, ['class' => 'selection-search-clear select-form', 'id' => 'sales_status']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Find" class="btn btn-primary" title="Search Data"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif 
<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Daftar
        </h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <th width="5%" style='text-align:center'>No</th>
                        <th width="10%" style='text-align:center'>No Penjualan</th>
                        <th width="15%" style='text-align:center'>Nama Seller</th>
                        <th width="15%" style='text-align:center'>Nama Buyer</th>
                        <th width="10%" style='text-align:center'>Metode Pembayaran</th>
                        <th width="10%" style='text-align:center'>Batas Tgl Pembayaran</th>
                        <th width="10%" style='text-align:center'>Tgl Pembayaran</th>
                        <th width="10%" style='text-align:center'>Total Harga</th>
                        <th width="10%" style='text-align:center'>Status</th>
                        <th width="5%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($sales as $item)
                    <tr>
                        <td style='text-align:center'>{{$no}}</td>
                        <td>{{$item['sales_no']}}</td>
                        <td>{{$item['seller_name']}}</td>
                        <td>{{$item['buyer_name']}}</td>
                        <td>{{$item['payment_name']}}</td>
                        <td>{{$item['payment_due_date']}}</td>
                        <td>{{$item['payment_date']}}</td>
                        <td style='text-align:right'>{{number_format($item['sales_price'])}}</td>
                        <td>{{$salesstatus[$item['sales_status']]}}</td>
                        <td class="">
                            <a type="button" class="btn btn-outline-warning btn-sm" href="{{ url('/sales/detail/'.$item['sales_id']) }}">Detail</a>
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