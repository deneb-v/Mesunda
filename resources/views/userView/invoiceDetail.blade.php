@extends('layouts.app')

@section('navbar')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('invoiceListView') }}">Invoice List</a>
    </li>
@endsection

@section('content')
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
                    $no=1;
                    $grandtotal = 0;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$item->photo) }}" alt="" width="100px" height="100px">
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
            </tbody>
        </table>
        <div>
            <label>Address : {{ $data[0]->address }}</label> <br>
            <label>Postal code : {{ $data[0]->postal_code }}</label>
            <a href="{{ route('printInvoice',['id' => $data[0]->id]) }}" class="btn btn-primary btn-block">Print</a>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function grandTotal(){
            subTotal = document.getElementsByClassName('subtotal');
            var grandtotal = 0;
            for(let x=0;x<subTotal.length;x++){
                let tmp = subTotal[x].innerHTML;
                tmp = tmp.substring(3);
                tmp = parseInt(tmp);
                grandtotal += tmp;
            }
            document.getElementById('txt_grandTotal').innerHTML = 'Rp.'+grandtotal;
        }

        function quantityChange(id, price){
            console.log(document.getElementById('txt_number'+id));
            console.log('id '+id);
            console.log('price '+price);
            let quantity = document.getElementById('txt_number'+id).value;
            console.log('Rp.'+quantity*price);
            document.getElementById('txt_subtotal'+id).innerHTML = 'Rp.'+quantity*price;
            grandTotal();
        }

        grandTotal();
    </script>
@endsection
