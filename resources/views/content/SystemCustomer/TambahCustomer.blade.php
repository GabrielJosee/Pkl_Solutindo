@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('customer') }}">Daftar Customer</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Customer</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Tambah Customer
    </h3>
    <br />

    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Tambah
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('customer') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>~
        </div>

        <form method="" action="{{url('/customer/tambah/process')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Nama<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="customer_name" id="customer_name"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Alamat<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="customer_address"
                                id="customer_address" value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a class="text-dark">Jenis Kelamin<a class='red'> *</a></a>
                        <select class="selection-search-clear" name="customer_gender" style="width: 100% !important">
                          <option value="1">Laki Laki</option>
                          <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Umur<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="number" name="customer_age" id="customer_age"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">No HP</a>
                            <input class="form-control input-bb" type="number" name="customer_phone" id="customer_phone"
                                value="" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                            class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i>
                        Simpan</button>
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







