@extends('layout')

@section('title', 'SQl View')


@section('content')
    <div class="col-md-12">
        <h3>Router SQL View</h3>
        
        <div class="row">
            <table class="table table-border" id="myTable">
                <thead>
                    <th>SapID</th>
                    <th>Host Name</th>
                    <th>Loop Back</th>
                    <th>Mac Address</th>
                    <th>Created at</th>
                </thead>
                <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->sapid }}</td>
                    <td>{{ $detail->host_name }}</td>
                    <td>{{ $detail->loop_back }}</td>
                    <td>{{ $detail->mac_address }}</td>
                    <td>{{ $detail->created_at }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
    

@endsection