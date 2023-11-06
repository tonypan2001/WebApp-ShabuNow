<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Menu;

class MenuTest extends TestCase
{    
    use RefreshDatabase;
    public function test_api_route_show_all_menu_return_status_200_ok()
    {       
        $response = $this->get('/api/menu');
        $response->assertStatus(200);
    }
    public function test_api_route_show_one_menu_return_status_200_ok()
    {       
        $category = Category::make([
            'name' => 'Pizzas'
        ]);
        $category->save(); // บันทึกผู้ใช้ให้กับฐานข้อมูล
        
        $menu = Menu::make([
            "name" => "Hawaiian Pizza",
            "price" => 125,
            "category_id" => 1,
            "status" => 'available',
            "description" => "Canadian bacon, homemade pizza dough, pizza sauce," 
        ]);
        $menu->save();
        $response = $this->get('/api/menu/show/1');
        $response->assertStatus(200);
    }

    public function test_api_store_menu_return_status_201_successful()
    {       
        $category = Category::make([
            'name' => 'Pizzas'
        ]);
        $category->save(); // บันทึกผู้ใช้ให้กับฐานข้อมูล
        
        $menu = [
            "name" => "Hawaiian Pizza",
            "price" => 125,
            "category" => $category->name,
            "status" => 'available',
            "description" => "Canadian bacon, homemade pizza dough, pizza sauce," 
        ];
        $response = $this->postJson('/api/menu/store',$menu);
        $response->assertStatus(201);        
    }
    public function test_api_store_menu_returns_status_422_invaild_input()
    {       
        $category = Category::make([
            'name' => 'Pizzas'
        ]);
        $category->save(); // บันทึกผู้ใช้ให้กับฐานข้อมูล
        
        $menu = [
            "name" => 1150,
            "price" => 125,
            "category" => $category->name,
            "status" => 'available',
            "description" => "Canadian bacon, homemade pizza dough, pizza sauce," 
        ];
        $response = $this->postJson('/api/menu/store',$menu);
        $response->assertStatus(422);        
    }
    public function test_api_store_menu_returns_status_404_invaild_route()
    {       
        $category = Category::make([
            'name' => 'Pizzas'
        ]);
        $category->save(); // บันทึกผู้ใช้ให้กับฐานข้อมูล
        
        $menu = [
            "name" => "Hawaiian Pizza",
            "price" => 125,
            "category" => $category->name,
            "status" => 'available',
            "description" => "Canadian bacon, homemade pizza dough, pizza sauce," 
        ];
        $response = $this->postJson('/api/menu/store!!!',$menu);
        $response->assertStatus(404);        
    }
}
