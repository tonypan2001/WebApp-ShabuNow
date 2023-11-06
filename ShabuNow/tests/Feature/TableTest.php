<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Table;

class TableTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_api_route_show_all_table_return_status_200_ok()
    {       
        $response = $this->get('/api/table');
        $response->assertStatus(200);
    }
    public function test_api_route_show_one_table_return_status_200_ok()
    {
        $table = Table::make([
            'status' => 'available',
        ]);
        $table->save(); // บันทึกผู้ใช้ให้กับฐานข้อมูล        
        $response = $this->get('/api/table/1');
        $response->assertStatus(200);
    }
    public function test_api_store_table_return_status_200_successful()
    {                       
        $response = $this->postJson('/api/table/create');
        $response->assertStatus(200);        
    }
    public function test_api_update_table_return_status_200_successful()
    {
        $table = Table::create([
            'status' => 'available',
        ]);
    
        // ส่งคำขอ PUT เพื่ออัปเดตสถานะ
        $response = $this->put('/api/table/update/' . $table->id, [
            'status' => 'available', // สถานะใหม่ที่คุณต้องการตั้งค่า
        ]);
        $response->assertStatus(200);        
    }
    public function test_api_store_table_return_status_405_invaild_route()
    {                       
        $response = $this->postJson('/api/table/create!!');
        $response->assertStatus(405);        
    }
}
