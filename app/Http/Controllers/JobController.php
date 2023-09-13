<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     
        if ($request->ajax()){

            $data = job::get()->all();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip" id="edit"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editJob">Edit</a>';
                $button = $button.' <a href="javascript:void(0)" data-toggle="tooltip" id="delete"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteJob">Delete</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);
        // $data = @dd($request->all());
        // return response()->json($data);
        job::updateOrCreate(['id'=>$request->id],
        [
           'name' => $request->name,
       ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = job::find($id);
        return response()->json($data);
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
       $data = job::findOrFail($id);
       $data->delete();
    //    return->response()->json($data);
    //    return redirect('/admin');
    }
}
