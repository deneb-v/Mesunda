@extends('layouts.app')

@section('navbar')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin') }}">Manage Item</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('addItemView') }}">Add Item</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        @if (Session::has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <table id="tbl_item" class="table">
            <thead>
                <tr>
                    {{-- 'name',
                    'category',
                    'price',
                    'stock',
                    'photo' --}}
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Photo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        @if ($item->photo == null)
                            No Photo
                        @else
                            <img src="{{asset('storage/'.$item->photo)}}" alt="img" srcset="" width="160px">
                        @endif
                    </td>
                    <td><a href="{{ route('updateItemView',['id' => $item->id]) }}" class="btn btn-primary btn-block">Edit</a></td>
                    <td>
                        <form action="{{ route('deleteItem',['id' => $item->id]) }}" method="post">
                            {{ csrf_field() }}
                            @method('delete')
                            <button onclick="return confirm('Delete {{$item->name}}?')" class="btn btn-danger btn-block">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
    $(document).ready(function () {
        $('#tbl_item').DataTable();
    });
    </script>
@endsection
