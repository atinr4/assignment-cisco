<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RouterDetail;
use App\RouterDetailView;
use DB;
class RouterDetailsController extends Controller
{
    public function index()
    {
        $routerDetails = RouterDetail::paginate(10);
        return view('router.index', ['details' => $routerDetails]);
    }

    public function create(Request $request)
    {
        
        $validatedData = $request->validate([
            'sapid' => 'required|max:18',
            'host_name' => 'required',
            'loop_back' => 'required|ipv4',
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
        ]);
        $routerDetails = RouterDetail::paginate(10);
        if ($validatedData) {
            $getAll = $request->all();
            if (RouterDetail::where('loop_back', $getAll['loop_back'])->orWhere('mac_address', $getAll['mac_address'])->count() == 0) {  
               
                $newDetails = new RouterDetail();
                $newDetails->sapid= $getAll['sapid'];
                $newDetails->host_name= $getAll['host_name'];
                $newDetails->loop_back= $getAll['loop_back'];
                $newDetails->mac_address= $getAll['mac_address'];
                $newDetails->save();

                return view('router.index', ['details' => $routerDetails,'class'=>'success', 'message' => 'Successfully created']);
            }
            return view('router.index', ['details' => $routerDetails,'class'=>'warning', 'message' => 'Loop back/Mac Address already exists']);
        }
        return view('router.index', ['details' => $routerDetails, 'class'=>'danger', 'message' => 'Unable to create']);
    }


    public function deleteDetails($id)
    {
        $data = RouterDetail::find($id);
        if($data->delete()) { 
            return redirect('/');
        }
    }

    public function editView($id)
    {
        $data = RouterDetail::find($id);
        return view('router.edit', ['details' => $data]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'sapid' => 'required|max:18',
            'host_name' => 'required',
            'loop_back' => 'required|ipv4',
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
        ]);

        if ($validatedData) {
            $getAll = $request->all();
            $newDetails = RouterDetail::find($getAll['id']);
            $newDetails->sapid= $getAll['sapid'];
            $newDetails->host_name= $getAll['host_name'];
            $newDetails->loop_back= $getAll['loop_back'];
            $newDetails->mac_address= $getAll['mac_address'];
            $newDetails->save();
        }
        return redirect('/');
    }

    //API Methods
    public function apiCreate(Request $request)
    {

        $validatedData = $request->validate([
            'sapid' => 'required|max:18',
            'host_name' => 'required',
            'loop_back' => 'required|ipv4',
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
        ]);

        if (!is_array($validatedData) && $validatedData->fails()) {
            return response()->json(['message' => $validatedData->messages()->first(), 'status' => 409], 200);
        }

        $getAll = $request->all();
        if (RouterDetail::where('loop_back', $getAll['loop_back'])->orWhere('mac_address', $getAll['mac_address'])->count() == 0) {           
            $newDetails = new RouterDetail();
            $newDetails->sapid= $getAll['sapid'];
            $newDetails->host_name= $getAll['host_name'];
            $newDetails->loop_back= $getAll['loop_back'];
            $newDetails->mac_address= $getAll['mac_address'];
            $newDetails->save();

            return response()->json(['message' => 'Record Created', 'status' => 200, 'data'=>$newDetails], 200);
        } 

        return response()->json(['message' => 'Loop back/Mac Address already exists', 'status' => 409], 200);
    }

    public function apiUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'sapid' => 'required|max:18',
            'host_name' => 'required',
            'ip_address' => 'required|ipv4',
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
        ]);

        if (!is_array($validatedData) && $validatedData->fails()) {
            return response()->json(['message' => $validatedData->messages()->first(), 'status' => 409], 200);
        }

        $getAll = $request->all();
        if (RouterDetail::where('loop_back', $getAll['ip_address'])->count()) {   
            $newDetails = RouterDetail::where('loop_back', $getAll['ip_address'])->first();
            $newDetails->sapid= $getAll['sapid'];
            $newDetails->host_name= $getAll['host_name'];
            $newDetails->loop_back= $getAll['ip_address'];
            $newDetails->mac_address= $getAll['mac_address'];
            $newDetails->save();

            return response()->json(['message' => 'Record Updated', 'status' => 200, 'data'=>$newDetails], 200);
        }

        return response()->json(['message' => 'Details not exsist', 'status' => 409], 200);
    }


    public function apiList(Request $request)
    {
        $routerDetails = RouterDetail::where('deleted_at', null);
        if ($request->has('ip_range')){
            if (strpos($request->get('ip_range'), '-') !== false) {
                $ipRangeArray = $this->rangeResolver($request->get('ip_range'));
                $routerDetails->whereIn('loop_back', $ipRangeArray);
            } else {
                $ipRangeArray = $request->get('ip_range');
                $routerDetails->where('loop_back','LIKE', $request->get('ip_range').'%');
            }
        }

        if ($request->has('sapid')){
            $routerDetails->where('sapid','LIKE', $request->get('sapid').'%');
        }

        $routerDetails = $routerDetails->paginate(10);
        
        return response()->json(['message' => 'Listing Successful', 'status' => 200, 'data'=>$routerDetails], 200);
    }


    public function apiDelete(Request $request)
    {
        $getAll = $request->all();
        if ($request->has('ip_address')){
            $data = RouterDetail::where('loop_back', $getAll['ip_address'])->first();
            if(isset($data) && $data->delete()) { 
                return response()->json(['message' => 'Record deleted Successful', 'status' => 200], 200);
            }
            return response()->json(['message' => 'Record not found', 'status' => 409], 200);
        }
    }

    public function rangeResolver($ip)
    {
      $ip = trim($ip);
      if (strpos($ip, ',') !== false) {
        $range = explode(',', $ip);

        return array_map('trim', $range);

      } elseif (strpos($ip, '-') !== false) {

        $range = explode('-', $ip);
        $start = ip2long($range[0]);
        $end = ip2long($range[1]);

        return array_map('long2ip', range($start, $end) );
      }
    }

    public function generateView()
    {
        $generateData = RouterDetailView::get();
        return view('router.sqlview', ['details' => $generateData]);
    }
}
