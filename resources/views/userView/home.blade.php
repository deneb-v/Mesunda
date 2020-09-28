@extends('layouts.app')

@section('navbar')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('invoiceListView') }}">Invoice List</a>
    </li>
@endsection

@section('navbar-right')
    <form id="cart" method="post" action="{{ route('checkOut') }}" >
        {{ csrf_field() }}
        <button id="btn_chkout" class="btn btn-primary mr-3 my-sm-0" type="submit">Check out</button>
    </form>
@endsection

@section('content')
    <div class="container-fluid">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-warning" role="alert">
                {{Session::get('error')}}
            </div>
        @endif
        <div class="row justify-content-center">
            @foreach ($data as $item)
                <div class="col-4 mt-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        @if ($item->photo == '')
                            <div class="d-flex align-items-center justify-content-center" style="height:200px; background-color: #C1CDCD">
                                <p class="text-center p-0 m-0">No Image</p>
                            </div>
                        @else
                            <img src="{{asset('storage/'.$item->photo)}}" class="card-img-top" alt="Product Image" style="object-fit: cover; height: 200px">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $item->name }}
                                @if ($item->stock <= 0)
                                    <span class="badge badge-danger">Out of Stock</span>
                                @endif
                            </h5>
                            <p class="card-text">Rp.{{ $item->price }}</p>
                            @if ($item->stock <= 0)
                                <button class="btn btn-primary" onclick="addToCart({{$item->id}})" disabled>Add to cart</button>
                            @else
                                <button class="btn btn-primary" onclick="addToCart({{$item->id}})">Add to cart</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        var chkOut = [];

        function addToCart(id) {
            let lenBef = chkOut.length;
            chkOut.push(id);
            chkOut = chkOut.filter((value, index, self) =>{
                return self.indexOf(value) === index;
            });
            let lenAft = chkOut.length;
            if(lenBef < lenAft){
                document.getElementById('cart').innerHTML += '<input name="data[]" type="hidden" value='+id+'>'
            }
            document.getElementById('btn_chkout').innerHTML = 'Check out ('+chkOut.length+')';
            console.log(chkOut);
        }
    </script>
@endsection
