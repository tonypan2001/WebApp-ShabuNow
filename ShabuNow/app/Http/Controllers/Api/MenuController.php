<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $menus = Menu::all();
        if($menus->count() > 0){
        return response()->json([
            'status' => 200,
            'menus' => $menus
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
        $menu = Menu::find($id);
        if($menu) {
            return response()->json([
                'status' => 200,
                'menu' => $menu
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such a menu found"
            ],404);
        }
    }
    public function edit(Request $request,int $id){
        
        $menu = Menu::find($id);
        if($menu) {
            return response()->json([
                'status' => 200,
                'menu' => $menu
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such a menu found"
            ],404);
        }
            }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,int $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',                        
            'description' => 'required',            
            'price' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->message()
            ],422);
        }else{
            $menu = Menu::find($id);
            
            if($menu){
                $menu->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'description' => $request->description
                    ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Menu updated Successfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "NO such menu find"
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

        $menu = new Menu();

        $menu->name = $request->get('name');
        $menu->price = $request->get('price');
        $menu->category_id = $category->id;
        $menu->description = $request->get('description');
        $menu->status = 'available';

        if($request->file('image') != null )
        {
            $imagePath = $request->file('image')->store('foodImages', 'public');
            $menu->imgPath = $imagePath;
        }

        $menu->save();
        $menu->refresh();

        return $menu;
    }
}