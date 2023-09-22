<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Pembelian</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Pembelian</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                    <th width="6%"><b>No</b></th>
                    <th width="23%"><b>Pemasok</b></th>
                    <th width="23%"><b>Produk</b></th>
                    <th width="15%"><b>Jumlah Beli</b></th>
                    <th width="23%"><b>Harga</b></th>
                    <th width="10%"><b>Diskon</b></th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($purchase as $purchases)
                <tr align="center">
                    <td width="6%">{{ $no }}</td>
                    <td width="23%" align="left">{{ $purchases['supplier_name'] }}</td>
                    <td width="23%">{{ $purchases->callProduct['product_name'] }}</td>
                    <td width="15%">{{ $purchases['purchase_amount'] }}</td>
                    <td width="23%" align="right">Rp {{ number_format($purchases['purchase_price']) }},00</td>
                    <td width="10%">
                        @if ($purchases['purchase_discount'] == 0.0)
                            -
                        @else
                            {{ $purchases['purchase_discount'] * 100 }}%
                        @endif
                    </td>
                </tr>
                <?php $no++; ?>
            @endforeach
        </table>
    </div>
</body>

</html>
