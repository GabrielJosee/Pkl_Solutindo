@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('vouchers') }}">Daftar Voucher</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Voucher</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Voucher
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
            Form Edit
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('vouchers') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>
<form method="" action="{{url('/vouchers/edit/process/' . $voucher['vouchers_id'])}}" enctype="multipart/form-data">
    @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama Voucher<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="vouchers_name" id="vouchers_name" value="{{$voucher['vouchers_name']}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Awal<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="date" name="start_date" id="start_date" value="{{$voucher['start_date']}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Akhir<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="date" name="end_date" id="end_date" value="{{$voucher['end_date']}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nominal<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="number" name="nominal" id="nominal" value="{{$voucher['nominal']}}" autocomplete="off"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
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