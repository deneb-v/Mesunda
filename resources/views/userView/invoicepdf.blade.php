<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path().'/css/app.css' }}">
</head>
<body class="bg-white">
    <div class="">
        <h1 class="text-center">MESUNDA SHOP INVOICE</h1>
        <h4 id="invID" class="text-center text-muted">No. {{ $data[0]->id }}</h4>
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                </tr>

                    @php
                        $no=1;
                        $grandtotal = 0;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>
                                <img src="{{ public_path().'/storage/'.$item->photo }}" alt="" width="100px" height="100px">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp.{{ $item->price }}</td>
                            <td>Rp.{{ $item->price * $item->quantity }}</td>
                        </tr>
                        @php
                            $no++;
                            $grandtotal+=$item->price * $item->quantity;
                        @endphp
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Grand Total</td>
                        <td id="txt_grandTotal">Rp.{{ $grandtotal }}</td>
                    </tr>

            </table>
            <div>
                <label>Address : {{ $data[0]->address }}</label> <br>
                <label>Postal code : {{ $data[0]->postal_code }}</label>
            </div>
    </div>
</body>
</html>


