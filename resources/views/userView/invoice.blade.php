@extends('layouts.app')

@section('navbar-right')

@endsection

@section('content')
    <?php
        $data = session('data');
        $invoiceID = session('invoiceID');
    ?>


    <div class="bg-white ml-4 mr-4 p-3 shadow mb-5 bg-white rounded">
        <h1 class="text-center">INVOICE</h1>
        <h4 id="invID" class="text-center text-muted">No. {{ $invoiceID }}</h4>
        @if ($errors->any())
            <?php
                $invoiceID = old('invoiceID');
            ?>
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('saveInvoice',['userID' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="invoiceID" value="{{ $invoiceID }}">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                                <input type="hidden" name="item[]" value="{{ $item->id }}">
                            </td>
                            <td>
                                @if ($item->photo == '')
                                    <div class="d-flex align-items-center justify-content-center" style="height:100px; width:100px; background-color: #C1CDCD">
                                        <p class="text-center p-0 m-0">No Image</p>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/'.$item->photo) }}" alt="" width="100px" height="100px">
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category }}</td>
                            <td>
                                <input name="quantity[]" id="txt_quantity{{$item->id}}" type="number" min="1" max="{{ $item->stock }}" value="1"
                                    onchange="quantityChange({{$item->id}},{{$item->price}},{{$item->stock}})">
                            </td>
                            <td>Rp.{{ $item->price }}</td>
                            <td class="subtotal" id="txt_subtotal{{$item->id}}">Rp.{{ $item->price }}</td>
                        </tr>
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
            <div class="form-group">
                <label>Address</label>
                <input name="txt_address" type="text" class="form-control" id="txt_alamat" placeholder="Address">
            </div>
            <div class="form-group">
                <label>Postal Code</label>
                <input name="txt_postalcode" type="text" class="form-control" id="txt_kodepos" placeholder="Postal code">
            </div>
            <button type="submit" class="btn btn-primary" btn-lg btn-block">Save Invoice</button>
        </form>
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

        function quantityChange(id, price, stock){
            if (document.getElementById('txt_quantity'+id).value > stock) {
                document.getElementById('txt_quantity'+id).value = stock;
            }
            let quantity = document.getElementById('txt_quantity'+id).value;
            console.log('Rp.'+quantity*price);
            document.getElementById('txt_subtotal'+id).innerHTML = 'Rp.'+quantity*price;
            grandTotal();
        }

        grandTotal();
    </script>
@endsection
