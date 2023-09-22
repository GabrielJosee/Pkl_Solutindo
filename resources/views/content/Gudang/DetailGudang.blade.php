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
                        <input class="form-control input-bb" type="number" name="warehouse_id" id="warehouse_id" value="{{$gudang['warehouse_id']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Gudang</a>
                        <input class="form-control input-bb" type="text" name="warehouse_name" id="warehouse_name" value="{{$gudang['warehouse_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat</a>
                        <input class="form-control input-bb" type="text" name="address" id="address" value="{{$gudang['address']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Penanggung Jawab Gudang</a>
                        <input class="form-control input-bb" type="text" name="warehouse_responsible_name" id="warehouse_responsible_name" value="{{$gudang['warehouse_responsible_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No Hp</a>
                        <input class="form-control input-bb" type="text" name="number_phone" id="number_phone" value="{{$gudang['number_phone']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
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