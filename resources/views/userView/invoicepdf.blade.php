<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path().'/css/app.css' }}">
</head>
<body>
    <div class="bg-white ml-4 mr-4 p-3 shadow mb-5 bg-white rounded">
        <h1 class="text-center">INVOICE</h1>
        <h4 id="invID" class="text-center text-muted">No. {{ $data[0]->id }}</h4>
            <table class="table">
                <thead>
                    <th>No.</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                </thead>
                <tbody>
                    @php
                        // dd(public_path().'/storage/img/'.$data[0]->photo);
                        $no=1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <th>{{ $no }}</th>
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
                        @endphp
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Grand Total</td>
                        <td id="txt_grandTotal"></td>
                    </tr>
                </tbody>
            </table>
            <div>
                <label>Address</label>
                <p>{{ $data[0]->address }}</p>
            </div>
            <div class="form-group">
                <label>Postal Code</label>
                <p>{{ $data[0]->postal_code }}</p>
            </div>
    </div>
</body>
</html>


