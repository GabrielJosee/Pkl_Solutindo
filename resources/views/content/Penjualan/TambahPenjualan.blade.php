@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('sales') }}">Daftar Penjualan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Penjualan</li>
        </ol>
    </nav>


@stop

@section('content')

    <script>
        function getProductPrice(select) {
            var product_id = select.value;
            var url = "{{ route('getProductPrice') }}?product_id=" + product_id;
            $.get(url, function(data) {
                var selectedOption = select.options[select.selectedIndex];
                var productPrice = selectedOption.getAttribute('data-price');
                var input = $(select).closest('.form-group').next().find('input[name="product_price"]');
                $(input).val(productPrice);
            });
        }
    </script>
    {{-- pesan error --}}

    <h3 class="page-title">
        Form Tambah Penjualan
    </h3>
    <br />
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Tambah
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('sales') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>


        <form method="" action="{{ url('/sales/tambah/list') }}" enctype="multipart/form-data" id="formTambah">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Pelanggan<a class='red'> *</a></a>
                            <select class="form-control" aria-label="Default select example" name="customer_id"
                                id="customer_id">
                                @if ($customer_id == null)
                                    <option value="" selected hidden>-- Pilih Pelanggan --</option>
                                    @foreach ($Customer as $cs)
                                        @if ($cs['data_state'] == 0)
                                            <option value="{{ $cs['customer_id'] }}">{{ $cs['customer_name'] }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($Customer as $cs)
                                        @if ($cs->customer_id == $flash['customer_id'])
                                            <?php $selected = 'selected'; ?>
                                        @else
                                            <?php $selected = ''; ?>
                                        @endif
                                        <option value="{{ $cs->customer_id }}" {{ $selected }}>
                                            {{ $cs->customer_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Produk<a class='red'> *</a></a>
                            <select class="form-control" name="product_id" id="product_id">
                                @if ($product_id == '')
                                    <option value="" selected hidden>-- Pilih Produk --</option>
                                    @foreach ($Product as $prod)
                                        <option value="{{ $prod['product_id'] }}"
                                            data-price="{{ $prod['product_price'] }}">
                                            {{ $prod['product_name'] }}</option>
                                    @endforeach
                                @else
                                    @foreach ($Product as $prod)
                                        @if ($prod->product_id == $product_id)
                                            <?php $selected = 'selected'; ?>
                                        @else
                                            <?php $selected = ''; ?>
                                        @endif
                                        <option value="{{ $prod->product_id }}" {{ $selected }}>
                                            {{ $prod->product_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    @if ($productSelected !== null)
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Harga<a class='red'> *</a></a>
                                <input class="form-control" type="text" name="product_price" id="product_price"
                                    value="Rp {{ number_format($productSelected['product_price']) }},00" readonly />
                            </div>
                        </div>
                    @else
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Harga<a class='red'> *</a></a>
                                <input class="form-control" type="text" name="product_price" id="product_price"
                                    value="" readonly />
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Gudang<a class='red'> *</a></a>
                            <select class="form-control" name="warehouse_id" id="warehouse_id">
                                @if ($warehouse_id == null)
                                    <option value="" selected hidden>-- Pilih Gudang --</option>
                                    @foreach ($Warehouse as $ware)
                                        <option value="{{ $ware['warehouse_id'] }}"
                                            data-price="{{ $ware['warehouse_id'] }}">
                                            {{ $ware['warehouse_name'] }}</option>
                                    @endforeach
                                @else
                                    @foreach ($Warehouse as $ware)
                                        @if ($ware->warehouse_id == $flash['warehouse_id'])
                                            <?php $selected = 'selected'; ?>
                                        @else
                                            <?php $selected = ''; ?>
                                        @endif
                                        <option value="{{ $ware->warehouse_id }}" {{ $selected }}>
                                            {{ $ware->warehouse_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Jumlah Produk<a class='red'> *</a></a>
                            <input class="form-control" type="number" name="product_amount" id="product_amount"
                                @if ($flash == null) value="" @else value="{{ $flash['product_amount'] }}" @endif />

                            @if ($flash && $flash['product_amount'] > 0 && $flash['product_amount'] > $product_stock)
                                <p class="text-danger">Jumlah produk yang diminta melebihi stok yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Diskon (%)</a>
                            <input class="form-control" type="number" name="sales_discount" id="sales_discount"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Keterangan<a class='red'> *</a></a>
                            <input class="form-control" type="text" name="sales_remark" id="sales_remark"
                                @if ($flash == null) value=""
                            @else
                                value="{{ $flash['sales_remark'] }}" @endif />
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
                        <button class="btn btn-success" onclick='processAddArrayPenjualan()'><i class="fa fa-plus"></i>
                            Tambah</button>
                    </div>
                </div>
            </div>
    </div>
    <input type="number" value="0" id="id" name="id" hidden>
    </form>
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
                            <th style='text-align:center'>Pelanggan</th>
                            <th style='text-align:center'>Produk</th>
                            <th style='text-align:center'>Gudang</th>
                            <th style='text-align:center'>Jumlah Produk</th>
                            <th style='text-align:center'>Harga</th>
                            <th style='text-align:center'>Keterangan</th>
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
                                    <tr>
                                        <td style='text-align:center' width='5%'>{{ $no }}</td>
                                        <td style='text-align:center' width='15%'>{{ $list[$i]['customer_name'] }}
                                        </td>
                                        <td style='text-align:center' width='15%'>{{ $list[$i]['product_name'] }}</td>
                                        <td style='text-align:center' width='15%'>{{ $list[$i]['warehouse_name'] }}
                                        </td>
                                        <td style='text-align:center' width='10%'>{{ $list[$i]['product_amount'] }}
                                        </td>
                                        <td style='text-align:center' width='15%'>Rp
                                            {{ number_format($list[$i]['product_price']) }},00
                                        </td>
                                        <td style='text-align:center' width='20%'>
                                            <textarea id="" cols="50" rows="2" readonly>{{ $list[$i]['sales_remark'] }}</textarea>
                                        </td>
                                        <td style='text-align:center' width='5%'>
                                            <a type="button" class="btn btn-outline-danger btn-sm"
                                                href="{{ url('/sales/tambah/hapus/' . $i) }}">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                    $subtotal += $list[$i]['product_price'];
                                    ?>
                                @endif
                            @endfor
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="3"></th>
                                <th style='text-align:center' colspan="2">Subtotal</th>
                                <th style='text-align:center' id="subtotal1">Rp {{ number_format($subtotal) }},00</th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th style='text-align:center'>Voucher</th>
                                <th>
                                    <select class="form-control" name="voucher_id" id="voucher_id"
                                        style="width: 100% !important">
                                        <option value="" hidden>-- Pilih Voucher --</option>
                                        @foreach ($voucher as $vouchers)
                                            <option value="{{ $vouchers->vouchers_id . '|' . $vouchers->nominal }}">
                                                {{ $vouchers->vouchers_name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th style='text-align:center' id="voucherText"></th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th style='text-align:center' colspan="2">Subtotal</th>
                                <th style='text-align:center' id="subtotalVoucher">Rp {{ number_format($subtotal) }},00
                                </th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th style='text-align:center'>Diskon (%)</th>
                                <th>
                                    <input class="form-control input-bb" type="number" name="totaldiskon"
                                        id="totaldiskon" />
                                </th>
                                <th style='text-align:center' id="totaldiskonText"></th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th style='text-align:center' colspan="2">Subtotal</th>
                                <th style='text-align:center' id="subtotal2">Rp {{ number_format($subtotal) }},00</th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th style='text-align:center'>PPN (%)</th>
                                <th>
                                    <input class="form-control input-bb" type="number" name="tax" id="tax" />
                                </th>
                                <th style='text-align:center' id="ppn"></th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th style='text-align:center' colspan="2">Total</th>
                                <th style='text-align:center' id="total">Rp {{ number_format($subtotal) }},00</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                </table>
                <form action="/sales/tambah/process" id="tambah">
                    <input class="form-control input-bb" type="text" name="subtotal" id="subtotal"
                        value="{{ $subtotal }}" hidden/>
                    <input class="form-control input-bb" type="text" name="hiddenVoucherID" id="hiddenVoucherID" hidden/>
                    <input class="form-control input-bb" type="text" name="hiddenVoucherNominal"
                        id="hiddenVoucherNominal" value="0.00" hidden/>
                    <input class="form-control input-bb" type="text" id="hiddensubtotal1"
                        value="{{ $subtotal }}" hidden/>
                    <input class="form-control input-bb" type="text" name="hiddenDiskonPersen"
                        id="hiddenDiskonPersen" hidden/>
                    <input class="form-control input-bb" type="text" name="hiddenDiskonValue"
                        id="hiddenDiskonValue" hidden/>
                    <input class="form-control input-bb" type="text" id="hiddensubtotal2"
                        value="{{ $subtotal }}" hidden/>
                    <input class="form-control input-bb" type="text" name="hiddenPPNPersen" id="PPNPersen" hidden/>
                    <input class="form-control input-bb" type="text" name="hiddenPPNValue" id="inputPPN" hidden/>
                    <input class="form-control input-bb" type="text" name="hiddenTotal" id="inputTotal" hidden/>
                    <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check"></i>
                        Simpan</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    <script>
        const product = document.getElementById('product_id');
        const form = document.getElementById('formTambah');
        product.addEventListener('change', () => {
            form.submit();
        });

        function processAddArrayPenjualan() {
            var customer_id = document.getElementById("customer_id").value;
            var product_id = document.getElementById("product_id").value;
            var product_price = document.getElementById("product_price").value;
            var warehouse_id = document.getElementById("warehouse_id").value;
            var product_amount = document.getElementById("product_amount").value;
            var sales_remark = document.getElementById("sales_remark").value;
            var id = document.getElementById("id");
            id.value = 1;

            $.ajax({
                type: "POST",
                url: "{{ route('sessionListSales') }}",
                data: {
                    'customer_id': customer_id,
                    'product_id': product_id,
                    'product_price': product_price,
                    'warehouse_id': warehouse_id,
                    'product_amount': product_amount,
                    'sales_remark': sales_remark,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(msg) {
                    location.reload();
                }
            });
        }

        const subtotal2 = document.getElementById("subtotal2");
        const ppnInput = document.getElementById("tax");
        const inputTotalDiskon = document.getElementById("totaldiskon");
        const ppnText = document.getElementById("ppn");
        const totaldiskonText = document.getElementById("totaldiskonText");
        const totalTxt = document.getElementById("total");
        const inputVoucher = document.getElementById("voucher_id");
        const voucherText = document.getElementById("voucherText");
        const subtotalVoucher = document.getElementById("subtotalVoucher");

        const hiddenVoucherID = document.getElementById("hiddenVoucherID");
        const hiddenVoucherNominal = document.getElementById("hiddenVoucherNominal");
        const hiddensubtotal1 = document.getElementById("hiddensubtotal1");
        const hiddensubtotal2 = document.getElementById("hiddensubtotal2");
        const hiddenDiskonPersen = document.getElementById("hiddenDiskonPersen");
        const hiddenDiskonValue = document.getElementById("hiddenDiskonValue");
        const hiddenPPNPersen = document.getElementById("PPNPersen");
        const hiddenPPN = document.getElementById("inputPPN");
        const hiddenTotal = document.getElementById("inputTotal");



        inputVoucher.addEventListener("change", function() {
            const subtotal = {{ $subtotal }};
            const voucherData = inputVoucher.value.split("|");
            const subtotal1Logic = subtotal - parseInt(voucherData[1]);
            voucherText.innerHTML = "Rp " + parseInt(voucherData[1]).toLocaleString('id-ID') + ",00";
            hiddenVoucherID.value = parseInt(voucherData[0]);
            hiddenVoucherNominal.value = parseInt(voucherData[1]);
            subtotalVoucher.innerHTML = "Rp " + subtotal1Logic.toLocaleString('id-ID') + ",00";
            hiddensubtotal1.value = subtotal1Logic;
            if (inputTotalDiskon.value == "" && ppnInput.value == "") {
                hiddensubtotal2.value = subtotal1Logic;
                subtotal2.innerHTML = "Rp " + subtotal1Logic.toLocaleString('id-ID') + ",00";
                hiddenTotal.value = subtotal1Logic;
                totalTxt.innerHTML = "Rp " + subtotal1Logic.toLocaleString('id-ID') + ",00";
            } else if (inputTotalDiskon.value != "" && ppnInput.value == "") {
                const diskonValue = inputTotalDiskon.value / 100 * subtotal1Logic;
                hiddenDiskonValue.value = diskonValue;
                totaldiskonText.innerHTML = "Rp " + diskonValue.toLocaleString('id-ID') + ",00";

                const subtotal2Logic = parseInt(hiddensubtotal1.value) - parseInt(hiddenDiskonValue.value);
                hiddensubtotal2.value = subtotal2Logic;
                subtotal2.innerHTML = "Rp " + subtotal2Logic.toLocaleString('id-ID') + ",00";
                hiddenTotal.value = subtotal2Logic;
                totalTxt.innerHTML = "Rp " + subtotal2Logic.toLocaleString('id-ID') + ",00";
            } else if (inputTotalDiskon.value == "" && ppnInput.value != "") {
                const ppn = ppnInput.value / 100 * subtotal1Logic;
                ppnText.innerHTML = "Rp " + ppn.toLocaleString('id-ID') + ",00";
                const total = parseInt(subtotal1Logic) + parseInt(ppn);
                totalTxt.innerHTML = "Rp " + total.toLocaleString('id-ID') + ",00";
                hiddenPPNPersen.value = ppnInput.value / 100;
                hiddenPPN.value = ppn;
                hiddenTotal.value = total;
            } else {
                const diskonValue = inputTotalDiskon.value / 100 * subtotal1Logic;
                hiddenDiskonValue.value = diskonValue;
                totaldiskonText.innerHTML = "Rp " + diskonValue.toLocaleString('id-ID') + ",00";
                const subtotal2Logic = parseInt(hiddensubtotal1.value) - parseInt(hiddenDiskonValue.value);
                hiddensubtotal2.value = subtotal2Logic;
                subtotal2.innerHTML = "Rp " + subtotal2Logic.toLocaleString('id-ID') + ",00";

                const ppn = ppnInput.value / 100 * subtotal2Logic;
                ppnText.innerHTML = "Rp " + parseInt(ppn).toLocaleString('id-ID') + ",00";
                const total = parseInt(subtotal2Logic) + parseInt(ppn);
                totalTxt.innerHTML = "Rp " + total.toLocaleString('id-ID') + ",00";
                hiddenPPNPersen.value = ppnInput.value / 100;
                hiddenPPN.value = ppn;
                hiddenTotal.value = total;
            }
        });

        inputTotalDiskon.addEventListener("change", function() {
            const subtotal = hiddensubtotal1.value;
            const diskonValue = inputTotalDiskon.value / 100 * subtotal;
            totaldiskonText.innerHTML = "Rp " + parseInt(diskonValue).toLocaleString('id-ID') + ",00";
            const subtotal2Logic = subtotal - diskonValue;
            subtotal2.innerHTML = "Rp " + subtotal2Logic.toLocaleString('id-ID') + ",00";
            hiddensubtotal2.value = subtotal2Logic;

            hiddenDiskonPersen.value = inputTotalDiskon.value / 100;
            hiddenDiskonValue.value = diskonValue;

            if (ppnInput.value == "") {
                totalTxt.innerHTML = "Rp " + subtotal2Logic.toLocaleString('id-ID') + ",00";
                hiddenTotal.value = subtotal2Logic;
            } else {
                const ppn = ppnInput.value / 100 * subtotal2Logic;
                ppnText.innerHTML = "Rp " + parseInt(ppn).toLocaleString('id-ID') + ",00";
                const total = parseInt(subtotal2Logic) + parseInt(ppn);
                totalTxt.innerHTML = "Rp " + total.toLocaleString('id-ID') + ",00";

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
            totalTxt.innerHTML = "Rp " + total.toLocaleString('id-ID') + ",00";

            hiddenPPNPersen.value = ppnInput.value / 100;
            hiddenPPN.value = ppn;
            hiddenTotal.value = total;
        });
    </script>



@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
