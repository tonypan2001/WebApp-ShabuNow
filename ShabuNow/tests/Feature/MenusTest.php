<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tests\TestCase;




class MenusTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_api_route_menu_status_return_ok()
    {       
        $response = $this->get('/api/menu');
        $response->assertStatus(200);
    }

    public function test_api_store_menu_successful()
    {       
        $menu = [
            "name" => "TestNdaf1cz23me",
            "price" => 1253,
            "category" => "Dr. Willie Marquardt dsfsfIII",
            "description" => "Te4stDescridfption",
            "category_id" => 19
        ];
        $response = $this->postJson('/api/menu/store',$menu);
        $response->assertStatus(201);        
    }
    public function test_api_store_invaild_menu_returns_error()
    {       
        $menu = [
            "name" => "TestNdaf1cz23me",            
            "category" => "Dr. Willie Marquardt dsfsfIII",
            "description" => "Te4stDescridfption",
            "category_id" => 19
        ];
        $response = $this->postJson('/api/menu/store',$menu);
        $response->assertStatus(422);        
    }
}
