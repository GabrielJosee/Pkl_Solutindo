@extends('adminlte::page')

@section('title', 'Tanggapan')    
@section('js')
@stop

@section('content_header')
    

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('customer') }}">Daftar Customer</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Customer</li>
    </ol>
</nav>


@stop

@section('content')

<h3 class="page-title">
    Form Detail Customer
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
            Detail Customer
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('customer') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form>
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">ID</a>
                        <input class="form-control input-bb" type="number" name="customer_id" id="customer_id" value="{{$customer['customer_id']}}" autocomplete="off" readonly/>

                        {{-- <input class="form-control input-bb" type="hidden" name="sales_id" id="sales_id" value="{{$salespayment['sales_id']}}"/> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama</a>
                        <input class="form-control input-bb" type="text" name="customer_name" id="customer_name" value="{{$customer['customer_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat</a>
                        <input class="form-control input-bb" type="text" name="customer_address" id="customer_address" value="{{$customer['customer_address']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Pendaftaran</a>
                        <input class="form-control input-bb" type="text" name="customer_register_date" id="customer_register_date" value="{{$customer['customer_register_date']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jenis Kelamin</a>
                        <input class="form-control input-bb" type="text" name="customer_gender" id="customer_gender" value="@if ($customer['customer_gender'] == 1)Laki - laki @elseif($customer['customer_gender'] == 2)Perempuan
                    @endif
                        " autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Umur</a>
                        <input class="form-control input-bb" type="text" name="customer_age" id="customer_age" value="{{$customer['customer_age']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="form-group">
                        <a class="text-dark">No Hp</a>
                        <input class="form-control input-bb" type="text" name="customer_phone" id="customer_phone" value="{{$customer['customer_phone']}}" autocomplete="off" readonly/>
                    </div>
                </div>
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

