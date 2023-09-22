@inject('SystemUserSellerRequest', 'App\Http\Controllers\SystemUserSellerRequestController')

@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Pengajuan Seller</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    <b>Daftar Pengajuan Seller</b> <small>Mengelola Pengajuan Seller</small>
</h3>
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
                        <th width="10%" style='text-align:center'>Nama Akun</th>
                        <th width="10%" style='text-align:center'>Nama Seller</th>
                        <th width="10%" style='text-align:center'>No Identitas</th>
                        <th width="5%" style='text-align:center'>Umur</th>
                        <th width="5%" style='text-align:center'>Jenis Kelamin</th>
                        <th width="10%" style='text-align:center'>Alamat Seller</th>
                        <th width="10%" style='text-align:center'>No HP</th>
                        <th width="5%" style='text-align:center'>Sosial Media</th>
                        <th width="5%" style='text-align:center'>Foto</th>
                        <th width="10%" style='text-align:center'>Nama Toko</th>
                        <th width="10%" style='text-align:center'>Alamat Toko</th>
                        <th width="5%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($sellerrequest as $seller)
                    <tr>
                        <td style='text-align:center'>{{$no}}</td>
                        <td>{{$seller['name']}}</td>
                        <td>{{$seller['seller_name']}}</td>
                        <td>{{$seller['seller_identity_no']}}</td>
                        <td>{{$seller['seller_age']}}</td>
                        <td>{{$seller['seller_gender']}}</td>
                        <td>{{$seller['seller_address']}}</td>
                        <td>{{$seller['seller_phone_number']}}</td>
                        <td>{{$seller['seller_social_media']}}</td>
                        <td>{{$seller['seller_photo']}}</td>
                        <td>{{$seller['seller_store_name']}}</td>
                        <td>{{$seller['seller_store_address']}}</td>
                        <td class="">
                            <a type="button" class="btn btn-outline-success btn-sm" href="{{ url('/seller-request/accept/'.$seller['user_id']) }}">Accept</a>
                            <a type="button" class="btn btn-outline-warning btn-sm" href="{{ url('/seller-request/reject/'.$seller['user_id']) }}">Reject</a>
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

@section('js')
    
@stop