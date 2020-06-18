@extends('layout')

@section('title', 'Page Title')


@section('content')
    <div class="col-md-12">
        <h3>Router Details</h3>
        <div class="row" style="margin-bottom:10px">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add Details
            </button>
        </div>
        @if(isset($class))
        <div class="alert alert-{{ $class }}">
            <p>{{ $message }}</p>
        </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search filter"  id="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
            </div>
        </div>
        <div class="row">
            <table class="table table-border" id="myTable">
                <thead>
                    <th>SapID</th>
                    <th>Host Name</th>
                    <th>Loop Back</th>
                    <th>Mac Address</th>
                    <th>Created at</th>
                    <th width="20%">Edit/ Delete</th>
                </thead>
                <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->sapid }}</td>
                    <td>{{ $detail->host_name }}</td>
                    <td>{{ $detail->loop_back }}</td>
                    <td>{{ $detail->mac_address }}</td>
                    <td>{{ $detail->created_at }}</td>
                    <td><a href="/edit-details/{{ $detail->id }}">Edit</a> | <a href="/delete-details/{{ $detail->id }}">Delete</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $details->appends(['sort' => 'created_at'])->links() }}
        </div>
        
    </div>
    
    

    


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="/" method="POST" id="createForm">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Router SapID</label>
                            <input type="text" class="form-control" name="sapid" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Host Name</label>
                            <input type="text" class="form-control" name="host_name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loop Back</label>
                            <input type="text" class="form-control" name="loop_back" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mac Address</label>
                            <input type="text" class="form-control" name="mac_address" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
    </div>
    </div>
@endsection