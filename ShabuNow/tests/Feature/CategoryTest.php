<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_api_route_show_all_category_return_status_200_ok()
    {       
        $response = $this->get('/api/category');
        $response->assertStatus(200);
    }
    public function test_api_store_category_return_status_200_successful()
    {
        $category = [
            "name" => "Drinking"
        ];
        $response = $this->postJson('/api/category/store',$category);                       
        $response->assertStatus(200);        
    }
    
    public function test_api_store_category_return_status_404_invaild_route()
    {
        $category = [
            "name" => "Drinking"
        ];
        $response = $this->postJson('/api/category/store!!',$category);                       
        $response->assertStatus(404);        
    }
}
