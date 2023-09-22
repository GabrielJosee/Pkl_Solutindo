@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('stock-adjustments') }}">Daftar Penyesuaian Stock</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Penyesuaian Stock</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Tambah Penyesuaian Stock
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
                <button onclick="location.href='{{ url('stock-adjustments') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form action="{{ url('/stock-adjustments/tambah/process') }}" enctype="multipart/form-data" id="formTambah">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Produk</a>
                            <br />
                            @if ($product_id == null)
                                <select class="form-control" name="product_id" id="product_id">
                                    <option selected hidden>-- Pilih Produk --</option>
                                    @foreach ($product as $prod)
                                        <option value="{{ $prod['product_id'] }}">{{ $prod['product_name'] }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select class="form-control" name="product_id" id="product_id">
                                    @foreach ($product as $prod)
                                        @if ($prod->product_id == $product_selected->product_id)
                                            <?php $selected = 'selected'; ?>
                                        @else
                                            <?php $selected = ''; ?>
                                        @endif
                                        <option value="{{ $prod->product_id }}" {{ $selected }}>
                                            {{ $prod->product_name }}</option>
                                    @endforeach
                                </select>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Jumlah Awal<a class='red'> *</a></a>
                            @if ($product_id !== null)
                                <input class="form-control" type="text" name="initial_amount" id="initial_amount"
                                    value="{{ $product_selected->product_stock }}" readonly />
                            @else
                                <input class="form-control" type="text" name="initial_amount" id="initial_amount"
                                    value="" readonly />
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Jumlah Penyesuaian<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="number" name="adjustment_amount"
                                id="adjustment_amount" />
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
    <script>
        const product = document.getElementById('product_id');
        const form = document.getElementById('formTambah');
        product.addEventListener('change', () => {
            const selectedValue = product.value;
            form.submit();
        });
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop
@section('js')

@stop