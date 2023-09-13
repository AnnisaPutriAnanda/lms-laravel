<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\personalGoal;

class personalGoalController extends Controller
{
    public function index(Request $request)
    {
     
        if ($request->ajax()){

            $data = personalGoal::get()->all();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip" id="edit" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editGoal">Edit</a>';
                $button = $button.' <a href="javascript:void(0)" data-toggle="tooltip" id="delete"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteGoal">Delete</a>';
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
        ]);

        personalGoal::updateOrCreate(['id'=>$request->id],
        [
           'name' => $request->name,
       ]);

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
        $data = personalGoal::find($id);
        return response()->json($data);
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
    public function destroy(string $id){

       $data = personalGoal::findOrFail($id);
       $data->delete();
    //    return response()->json($data);
    //    return redirect()->route('/admin');
       
}
}
