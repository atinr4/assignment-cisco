@extends('layout')

@section('title', 'Page Title')


@section('content')
    <div class="col-md-12">
        <h3>Edit Details</h3>
        
        <div class="row">
                    <form action="/editSubmit" method="POST" id="editForm">
                        @csrf
                        <input type="hidden" name="id" value="{{$details->id}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Router SapID</label>
                            <input type="text" class="form-control" name="sapid" value="{{$details->sapid}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">RHost Name</label>
                            <input type="text" class="form-control" name="host_name"  value="{{$details->host_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loop Back</label>
                            <input type="text" class="form-control" name="loop_back"  value="{{$details->loop_back}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mac Address</label>
                            <input type="text" class="form-control" name="mac_address" value="{{$details->mac_address}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
        </div>
        
    </div>
    
    

    


    
@endsection