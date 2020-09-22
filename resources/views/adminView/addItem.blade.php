@extends('layouts.app')

@section('navbar')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">Manage Item</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('addItemView') }}">Add Item</a>
    </li>
@endsection

@section('content')

    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <form action="{{ route('addItem') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
    {{-- 'name',
    'category',
    'price',
    'stock',
    'photo' --}}
            <div class="form-group">
                <label>Product Name</label>
                <input name="txt_name" type="text" class="form-control" id="txt_name" placeholder="Title">
            </div>
            <div class="form-group">
                <label>Product Category</label>
                <select name="category" id="cb_category" class="custom-select" onchange="catChange()">
                    <option value="zero" selected>Select category</option>
                    <option value="Electronic">Electronic</option>
                    <option value="Accessory">Accessory</option>
                    <option value="Wearable">Wearable</option>
                    <option value="Food">Food</option>
                    <option value="Drink">Drink</option>
                    <option value="Medicine">Medicine</option>
                    <option value="other">Other</option>
                </select>
                <input name="txt_category" type="text" class="form-control mt-3" id="txt_category" placeholder="Other Category" style="display: none">
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input name="txt_stock" type="text" class="form-control" id="txt_stock" placeholder="Stock">
            </div>
            <div class="form-group">
                <label>Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp.</div>
                    </div>
                    <input name="txt_price" type="text" class="form-control" id="txt_price" placeholder="Price">
                </div>
            </div>
            <div class="form-group">
                <label>Product Photo</label>
                <input name="img_product" type="file" class="form-control-file" id="img_article">
            </div>
            <button type="submit" name="" id="" class="btn btn-primary" btn-lg btn-block">Add Item</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function catChange(){
            var str = document.getElementById('cb_category').value;
            if(str === 'other'){
                document.getElementById('txt_category').style.display = ""
            }
            else{
                document.getElementById('txt_category').style.display = "none"
            }
        }
    </script>
@endsection
