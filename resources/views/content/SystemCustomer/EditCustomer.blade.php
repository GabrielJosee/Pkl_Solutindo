@extends('adminlte::page')

@section('title', 'Tanggapan')    
@section('js')
@stop

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('customer') }}">Daftar Customer</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Customer
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
            <button onclick="location.href='{{ url('customer') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form method="" action="{{url('/customer/edit/process/' . $customer['customer_id'])}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="customer_name" id="customer_name" value="{{$customer['customer_name']}}" autocomplete="off"/>

                        {{-- <input class="form-control input-bb" type="hidden" name="item_category_id" id="item_category_id" value="{{$invtitemcategory['item_category_id']}}"/> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Alamat<a class='red'> *</a></a>
                        <select class="form-control" type="text" name="customer_gender" id="customer_gender" value="{{$customer['customer_address']}}" autocomplete="off">
                            @if ($customer['customer_gender'] == 1)
                            <option value="1" selected>Laki - laki</option>
                            <option value="2">Perempuan</option>
                        @elseif($customer['customer_gender'] == 2)
                            <option value="2" selected>Perempuan</option>
                            <option value="1">Laki - laki</option>
                        @else
                            <option value="1">Laki - laki</option>
                            <option value="2">Perempuan</option>
                        @endif
                    </select>

                        {{-- <input class="form-control input-bb" type="hidden" name="item_category_id" id="item_category_id" value="{{$invtitemcategory['item_category_id']}}"/> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Jenis Kelamin<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="customer_address" id="customer_address" value="{{$customer['customer_address']}}" autocomplete="off"/>

                        {{-- <input class="form-control input-bb" type="hidden" name="item_category_id" id="item_category_id" value="{{$invtitemcategory['item_category_id']}}"/> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Umur<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="customer_age" id="customer_age" value="{{$customer['customer_age']}}" autocomplete="off"/>

                        {{-- <input class="form-control input-bb" type="hidden" name="item_category_id" id="item_category_id" value="{{$invtitemcategory['item_category_id']}}"/> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">No hp<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="customer_phone" id="customer_phone" value="{{$customer['customer_phone']}}" autocomplete="off"/>

                        {{-- <input class="form-control input-bb" type="hidden" name="item_category_id" id="item_category_id" value="{{$invtitemcategory['item_category_id']}}"/> --}}
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
