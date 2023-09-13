<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tools;
use DataTables;

class toolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){

            $data = Tools::get()->all();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip" id="edit" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editTools">Edit</a>';
                $button = $button.' <a href="javascript:void(0)" data-toggle="tooltip" id="delete"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteTools">Delete</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $ToolsId = $request->id;
        $input = [ 'name' => $request->name, ];

        if ($files = $request->file('image')) {
            //delete file lama
            \File::delete('public/image/'.$request->hidden_image);
            
            $destinationPath = 'public/image/'; //menentukan destinasi file
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension(); 
            $files->move($destinationPath, $profileImage);

            $input['image'] = "$profileImage";

        }

        $save =  Tool::updateOrCreate(['id' => $ToolsId], $input);  
           
        return Response::json($save);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
