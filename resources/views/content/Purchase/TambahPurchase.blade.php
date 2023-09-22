@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('purchase') }}">Daftar Pembelian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Pembelian</li>
        </ol>
    </nav>

@stop

@section('content')
    <h3 class="page-title">
        Form Tambah Pembelian
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
                <button onclick="location.href='{{ url('purchase') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="" action="{{ url('/purchase/tambah/list') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Pemasok<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="supplier_name" id="supplier_name"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Gudang</a>
                            <br />
                            {!! Form::select('warehouse_id', $gudang, null, [
                                'class' => 'selection-search-clear select-form',
                                'id' => 'warehouse_id',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Produk</a>
                            <br />
                            {!! Form::select('product_id', $product, null, [
                                'class' => 'selection-search-clear select-form',
                                'id' => 'product_id',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Jumlah Beli<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="number" name="purchase_amount" id="purchase_amount"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Harga<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="number" name="purchase_price" id="purchase_price"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Diskon (%)</a>
                            <input class="form-control input-bb" type="number" name="purchase_discount"
                                id="purchase_discount" value="" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                            class="fa fa-times"></i> Batal</button>
                    <button class="btn btn-success" onclick='processAddArrayPurchase()'><i class="fa fa-plus"></i>
                        Tambah</button>
                </div>
            </div>
        </form>

    </div>
    </div>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Pembelian
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Pemasok</th>
                            <th style='text-align:center'>Gudang</th>
                            <th style='text-align:center'>Produk</th>
                            <th style='text-align:center'>Jumlah Beli</th>
                            <th style='text-align:center'>Diskon(%)</th>
                            <th style='text-align:center'>Diskon</th>
                            <th style='text-align:center'>Harga</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <?php $subtotal = 0; ?>
                    @if (!count($list) == 0)
                        <tbody>
                            <?php
                            $count = -1;
                            foreach ($list as $index => $value) {
                                if (!is_null($value)) {
                                    $count = $index + 1;
                                }
                            }
                            $no = 1; ?>
                            @for ($i = 0; $i < $count; $i++)
                                @if (isset($list[$i]))
                                    <?php
                                    $diskon = $list[$i]['purchase_discount'] * $list[$i]['purchase_price'];
                                    ?>
                                    <tr>
                                        <td style='text-align:center' width='5%'>{{ $no }}</td>
                                        <td style='text-align:center' width='20%'>{{ $list[$i]['supplier_name'] }}</td>
                                        <td style='text-align:center' width='15%'>{{ $list[$i]['warehouse_name'] }}</td>
                                        <td style='text-align:center' width='15%'>{{ $list[$i]['product_name'] }}</td>
                                        <td style='text-align:center' width='10%'>{{ $list[$i]['purchase_amount'] }}
                                        </td>
                                        <td style='text-align:center' width='10%'>
                                            @if ($list[$i]['purchase_discount'] == 0.0)
                                                -
                                            @else
                                                {{ $list[$i]['purchase_discount'] * 100 }}%
                                            @endif
                                        </td>
                                        <td style='text-align:center' width='10%'>
                                            @if ($list[$i]['purchase_discount'] == 0.0)
                                                -
                                            @else
                                                Rp {{ number_format($diskon) }},00
                                            @endif
                                        </td>
                                        <td style='text-align:center' width='15%'>Rp
                                            {{ number_format($list[$i]['purchase_price']) }},00</td>
                                        <td style='text-align:center' width='5%'>
                                            <a type="button" class="btn btn-outline-danger btn-sm"
                                                href="{{ url('/purchase/tambah/hapus/' . $i) }}">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                    $subtotal += $list[$i]['purchase_price'];
                                    ?>
                                @endif
                            @endfor
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="5"></th>
                                <th style='text-align:center' colspan="2">Subtotal</th>
                                <th style='text-align:center' id="subtotal1">Rp {{ number_format($subtotal) }},00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5"></th>
                                <th style='text-align:center'>Diskon (%)</th>
                                <th>
                                    <input class="form-control input-bb" type="number" name="totaldiskon"
                                        id="totaldiskon" />
                                </th>
                                <th style='text-align:center' id="totaldiskonText"></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5"></th>
                                <th style='text-align:center' colspan="2">Subtotal</th>
                                <th style='text-align:center' id="subtotal2">Rp {{ number_format($subtotal) }},00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5"></th>
                                <th style='text-align:center'>PPN (%)</th>
                                <th>
                                    <input class="form-control input-bb" type="number" name="tax" id="tax" />
                                </th>
                                <th style='text-align:center' id="ppn"></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5"></th>
                                <th style='text-align:center' colspan="2">Total</th>
                                <th style='text-align:center' id="total">Rp {{ number_format($subtotal) }},00</th>
                                <th></th>
                            </tr>
                        </thead>
                    @endif
                </table>
                <form action="/purchase/tambah/process" id="tambah">
                    <input class="form-control input-bb" type="text" name="subtotal" id="subtotal"
                        value="{{ $subtotal }}" hidden />
                    <input class="form-control input-bb" type="text" id="hiddensubtotal2"
                        value="{{ $subtotal }}" hidden />
                    <input class="form-control input-bb" type="text" name="hiddenDiskonPersen"
                        id="hiddenDiskonPersen" hidden />
                    <input class="form-control input-bb" type="text" name="hiddenDiskonValue" id="hiddenDiskonValue"
                        hidden />
                    <input class="form-control input-bb" type="text" name="hiddenPPNPersen" id="PPNPersen" hidden />
                    <input class="form-control input-bb" type="text" name="hiddenPPNValue" id="inputPPN" hidden />
                    <input class="form-control input-bb" type="text" name="hiddenTotal" id="inputTotal" hidden />
                    <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const subtotal2 = document.getElementById("subtotal2");
        const ppnInput = document.getElementById("tax");
        const inputTotalDiskon = document.getElementById("totaldiskon");
        const ppnText = document.getElementById("ppn");
        const totaldiskonText = document.getElementById("totaldiskonText");
        const totalTxt = document.getElementById("total");

        const hiddensubtotal2 = document.getElementById("hiddensubtotal2");
        const hiddenDiskonPersen = document.getElementById("hiddenDiskonPersen");
        const hiddenDiskonValue = document.getElementById("hiddenDiskonValue");
        const hiddenPPNPersen = document.getElementById("PPNPersen");
        const hiddenPPN = document.getElementById("inputPPN");
        const hiddenTotal = document.getElementById("inputTotal");



        inputTotalDiskon.addEventListener("change", function() {
            const subtotal = {{ $subtotal }};
            const diskonValue = inputTotalDiskon.value / 100 * subtotal;
            totaldiskonText.innerHTML = "Rp " + diskonValue.toLocaleString('id-ID') + ",00";
            const subtotal2Logic = subtotal - diskonValue;
            subtotal2.innerHTML = "Rp " + subtotal2Logic.toLocaleString('id-ID') + ",00";
            hiddensubtotal2.value = subtotal2Logic;

            hiddenDiskonPersen.value = inputTotalDiskon.value / 100;
            hiddenDiskonValue.value = diskonValue;

            if (ppnInput.value == "") {
                totalTxt.innerHTML = "Rp " + parseInt(subtotal2Logic).toLocaleString('id-ID') + ",00";
                hiddenTotal.value = subtotal2Logic;
            } else {
                const ppn = ppnInput.value / 100 * subtotal2Logic;
                ppnText.innerHTML = "Rp " + parseInt(ppn).toLocaleString('id-ID') + ",00";
                const total = parseInt(subtotal2Logic) + parseInt(ppn);
                totalTxt.innerHTML = "Rp " + parseInt(total).toLocaleString('id-ID') + ",00";

                hiddenPPNPersen.value = ppnInput.value / 100;
                hiddenPPN.value = ppn;
                hiddenTotal.value = total;
            }
        });

        ppnInput.addEventListener("change", function() {
            const subtotal = hiddensubtotal2.value;
            const ppn = ppnInput.value / 100 * subtotal;
            ppnText.innerHTML = "Rp " + parseInt(ppn).toLocaleString('id-ID') + ",00";
            const total = parseInt(subtotal) + parseInt(ppn);
            totalTxt.innerHTML = "Rp " + parseInt(total).toLocaleString('id-ID') + ",00";

            hiddenPPNPersen.value = ppnInput.value / 100;
            hiddenPPN.value = ppn;
            hiddenTotal.value = total;
        });

        function processAddArrayPurchase() {
            var supplier_name = document.getElementById("supplier_name").value;
            var warehouse_id = document.getElementById("warehouse_id").value;
            var product_id = document.getElementById("product_id").value;
            var purchase_amount = document.getElementById("purchase_amount").value;
            var purchase_price = document.getElementById("purchase_price").value;
            var purchase_discount = document.getElementById("purchase_discount").value;

            $.ajax({
                type: "POST",
                url: "{{ route('sessionListPurchase') }}",
                data: {
                    'supplier_name': supplier_name,
                    'warehouse_id': warehouse_id,
                    'product_id': product_id,
                    'purchase_amount': purchase_amount,
                    'purchase_price': purchase_price,
                    'purchase_discount': purchase_discount,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(msg) {
                    location.reload();
                }
            });
        }
    </script>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
