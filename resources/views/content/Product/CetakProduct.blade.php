<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Customer</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID</th>
                <th>Kategori Produk</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Deskripsi Produk</th>
            </tr>
            @foreach ($product as $pro)
                <tr align="center">
                    <td> {{ $pro->product_id }}</td>
                    <td> {{ $pro->productCategory->product_category_name }}</td>
                    <td> {{ $pro->product_name }}</td>
                    <td> {{ $pro->product_price }}</td>
                    <td> {{ $pro->product_description }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
