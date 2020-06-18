@extends('layout')

@section('title', 'Page')


@section('content')
    <div class="col-md-8">
        <h3>API details</h3>
        <div class="form-group">
            <select name="api_lsit" id="api" class="form-control">
                <option value="{{URL::to('/api/login')}}">{{URL::to('/api/login')}}</option>
                <option value="{{URL::to('/api/create-records')}}">{{URL::to('/api/create-records')}}</option>
                <option value="{{URL::to('/api/update-records')}}">{{URL::to('/api/update-records')}}</option>
                <option value="{{URL::to('/api/list-records')}}">{{URL::to('/api/list-records')}}</option>
                <option value="{{URL::to('/api/delete-records')}}">{{URL::to('/api/delete-records')}}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><b>Payload</b></label>
            <textarea type="text" class="form-control" name="payload" id="payload" rows="10"></textarea>
        </div>
        <div class="form-group" id="headerDiv">
            <label for="exampleInputEmail1"><b>Authorization Header</b></label>
            <input type="text" class="form-control" name="payload" id="header">
        </div>
        <button class="form-control btn-primary" id="submit">Submit</button>

        <div class="form-group" id="headerDiv">
            <label for="exampleInputEmail1"><b>Response</b></label>
            <code id="showCode"></code>
        </div>

    </div>

    <div class="col-md-4">
        <h3>API Dummy Data</h3>
        <ol>
        <li><h5>Login</h5>
            {{URL::to('/api/login')}}
            
            <h6>Data</h6>
            <code>
            {
                "email":"marjorie.king@example.org",
                "password": "password"
            }
            </code>
        </li>
        <li><h5>Create Data</h5>
        {{URL::to('/api/create-records')}}
            
            <h6>Data</h6>
            <code>
            {
                "sapid":"5eea009f99183",
                "host_name": "localhost",
                "loop_back": "172.0.0.8",
                "mac_address": "2e:e5:e1:ee:36:5d"
            }
            </code>
        </li>
        <li><h5>Update Data</h5>
        {{URL::to('/api/update-records')}}
            
            <h6>Data</h6>
            <code>
            {
                "sapid":"5eea009f99183",
                "host_name": "localhost2",
                "ip_address": "172.0.0.4",
                "mac_address": "2e:e5:e1:ee:36:5d"
            }
            </code>
        </li>
        <li><h5>List Data</h5>
        {{URL::to('/api/list-records')}}
            
            <h6>Data</h6>
            For normal no data required
            <p>For IP range</p>
            <code>
            {
                "ip_range":"172.0.0.1-172.0.0.255"
            }
            </code>
        </li>
        <li><h5>Delete Data</h5>
        {{URL::to('/api/delete-records')}}
            
            <h6>Data</h6>
            <code>
            {
                "ip_address": "172.0.0.1"
            }
            </code>
        </li>
        </ol>
    </div>

    
    
@endsection