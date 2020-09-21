@extends('layouts.app')

@section('navbar')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">Manage Item</a>
    </li>
    <li class="nav-item">
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
        <form action="{{route('updateItem',['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
            @method('patch')
            {{ csrf_field() }}
    {{-- 'name',
    'category',
    'price',
    'stock',
    'photo' --}}
            <div class="form-group">
                <label>Product Name</label>
                <input name="txt_name" type="text" class="form-control" id="txt_title" placeholder="Title" value="{{ $data->name }}">
            </div>
            <div class="form-group">
                <label>Product Category</label>
                <input name="txt_category" type="text" class="form-control" id="txt_title" placeholder="Category" value="{{ $data->category }}">
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input name="txt_stock" type="text" class="form-control" id="txt_title" placeholder="Stock" value="{{ $data->stock }}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input name="txt_price" type="text" class="form-control" id="txt_title" placeholder="Price" value="{{ $data->price }}">
            </div>
            <div class="form-group">
                <div>
                    <label>Current Product Image</label>
                    <img src="{{ asset('storage/'.$data->photo) }}" alt="" srcset="" width="160px">
                </div>
                <label>New Product Image</label>
                <input name="img_product" type="file" class="form-control-file" id="img_product">
            </div>
            <button type="submit" name="" id="" class="btn btn-primary" btn-lg btn-block">Update Item</button>
        </form>
    </div>
@endsection
