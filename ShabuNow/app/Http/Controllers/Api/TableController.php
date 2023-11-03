<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// $table->id();
//             $table->timestamps();
//             $table->enum('status',['available', 'used']);
//             $table->foreignIdFor(\App\Models\User::class); // user_id (fk)


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $tables = Table::all();
        if($tables->count() > 0){
        return response()->json([
            'status' => 200,
            'tables' => $tables
        ],200);
    }else{
        return response()->json([
            'status' => 404,
            'message ' => 'No Records Found'
        ],404);
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id){
        $table = Table::find($id);
        if($table) {
            return response()->json([
                'status' => 200,
                'table' => $table
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such a table found"
            ],404);
        }
    }
    public function edit(Request $request,int $id){
        
        $table = Table::find($id);
        if($table) {
            return response()->json([
                'status' => 200,
                'table' => $table
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such a table found"
            ],404);
        }
            }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,int $id){
        $validator = Validator::make($request->all(), [
            // 'name' => 'required',                        
            'status' => 'required',            
            // 'user_id' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->message()
            ],422);
        }else{
            $table = Table::find($id);
            
            if($table){
                $table->update([                    
                    'status' => $request->status,
                    'user_id' => $request->user_id
                    ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Table updated Successfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "NO such table find"
                ],500);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:1'],
            'price' => ['required', 'integer', 'min:1'],
            'category' => ['required', 'string'],
            'description' => ['required', 'string', 'min:1'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        // Store image in 'public/images' folder


        // Search what category has the same name as selected
        $category = Category::where('name', $request->get('category'))->first();

        $table = new Table();

        $table->name = $request->get('name');
        $table->price = $request->get('price');
        $table->category_id = $category->id;
        $table->description = $request->get('description');
        $table->status = 'available';

        if($request->file('image') != null )
        {
            $imagePath = $request->file('image')->store('foodImages', 'public');
            $table->imgPath = $imagePath;
        }

        $table->save();
        $table->refresh();

        return $table;
    }
}