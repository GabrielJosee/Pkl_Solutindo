@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('system-user') }}">Daftar System User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail System User Seller</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Detail System User Seller
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
            <button onclick="location.href='{{ url('system-user') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form method="post" action="/system-user/process-edit-system-user" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-8">
                    <div class="form-group">
                        <a class="text-dark">Nama Akun</a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value="{{$systemuser['name']}}" readonly/>
                        <input class="form-control input-bb" type="hidden" name="user_id" id="user_id" value="{{$user_id}}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Foto</a>
                        <input class="form-control input-bb" type="text" name="seller_photo" id="seller_photo" value="{{$systemuserseller['seller_photo']}}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Seller</a>
                        <input class="form-control input-bb" type="text" name="seller_name" id="seller_name" value="{{$systemuserseller['seller_name']}}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No Identitas</a>
                        <input class="form-control input-bb" type="text" name="seller_identity_no" id="seller_identity_no" value="{{$systemuserseller['seller_identity_no']}}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Umur</a>
                        <input class="form-control input-bb" type="text" name="seller_age" id="seller_age" value="{{$systemuserseller['seller_age']}}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jenis Kelamin</a>
                        <input class="form-control input-bb" type="text" name="seller_gender" id="seller_gender" value="{{$systemuserseller['seller_gender']}}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat Seller</a>
                        <input class="form-control input-bb" type="text" name="seller_address" id="seller_address" value="{{$systemuserseller['seller_address']}}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No HP</a>
                        <input class="form-control input-bb" type="text" name="seller_phone_number" id="seller_phone_number" value="{{$systemuserseller['seller_phone_number']}}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Sosial media</a>
                        <input class="form-control input-bb" type="text" name="seller_social_media" id="seller_social_media" value="{{$systemuserseller['seller_social_media']}}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Toko</a>
                        <input class="form-control input-bb" type="text" name="seller_store_name" id="seller_store_name" value="{{$systemuserseller['seller_store_name']}}" readonly/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat Toko</a>
                        <input class="form-control input-bb" type="text" name="seller_store_address" id="seller_store_address" value="{{$systemuserseller['seller_store_address']}}" readonly/>
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

@section('js')
    
@stop