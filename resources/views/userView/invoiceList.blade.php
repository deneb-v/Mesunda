@extends('layouts.app')

@section('navbar')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('invoiceListView') }}">Invoice List</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        @if (Session::has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <table id="tbl_invoice" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->postal_code }}</td>
                    <td><a href="{{ route('printInvoice',['id' => $item->id]) }}" class="btn btn-primary btn-block">Print</a></td>
                    <td><a href="{{ route('invoiceDetailView',['id' => $item->id]) }}" class="btn btn-primary btn-block">See detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#tbl_invoice').DataTable();
        } );
    </script>
@endsection
