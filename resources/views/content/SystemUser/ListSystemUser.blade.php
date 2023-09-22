@inject('SystemUser', 'App\Http\Controllers\SystemUserController')

@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('js')
<script>
	$(document).ready(function(){
        var user_group_id        = {!! json_encode($user_group_id) !!};
        
        if(user_group_id == null){
            $("#user_group_id").select2("val", "0");
        }
    });
</script>
@stop

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">Daftar System User</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    <b>Daftar System User</b> <small>Mengelola System User </small>
</h3>
<br/>
<div id="accordion">
    <form  method="post" action="{{route('filter-system-user')}}" enctype="multipart/form-data">
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
                        <a class="text-dark">User Group</a>
                        <br/>
                        {!! Form::select('user_group_id',  $systemusergroup, $user_group_id, ['class' => 'selection-search-clear select-form', 'id' => 'user_group_id']) !!}
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
    <div class="form-actions float-right">
        <button onclick="location.href='{{ url('system-user/add') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah System User Baru</button>
    </div>
  </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <th width="2%" style='text-align:center'>User ID</th>
                        <th width="10%" style='text-align:center'>Nama</th>
                        <th width="20%" style='text-align:center'>User Group</th>
                        <th width="10%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($systemuser as $user)
                    <tr>
                        <td style='text-align:center'>{{$user['user_id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$SystemUser->getUserGroupName($user['user_group_id'])}}</td>
                        <td class="">
                            <a type="button" class="btn btn-outline-warning btn-sm" href="{{ url('/system-user/edit/'.$user['user_id']) }}">Edit</a>
                            <?php if($user['user_group_level'] == 2){ ?>
                                <a type="button" class="btn btn-outline-info btn-sm" href="{{ url('/system-user/detail-seller/'.$user['user_id']) }}">Detail</a>
                            <?php } else if($user['user_group_level'] == 3){?>
                                <a type="button" class="btn btn-outline-info btn-sm" href="{{ url('/system-user/detail-buyer/'.$user['user_id']) }}">Detail</a>
                            <?php } ?>
                            <?php 
                            if($user['user_group_id']!=1){
                                if($user['user_status'] == 0){ 
                            ?>
                                    <a type="button" class="btn btn-outline-danger btn-sm" href="{{ url('/system-user/blokir/'.$user['user_id']) }}">Blokir</a>
                            <?php } else if($user['user_status'] == 1){?>
                                    <a type="button" class="btn btn-outline-success btn-sm" href="{{ url('/system-user/unblokir/'.$user['user_id']) }}">Buka Blokir</a>
                            <?php 
                                } 
                            } 
                            ?>
                            <a type="button" class="btn btn-outline-danger btn-sm" href="{{ url('/system-user/delete-system-user/'.$user['user_id']) }}">Hapus</a>
                        </td>
                    </tr>
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