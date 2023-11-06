<?php

namespace Tests\Feature;
use App\Models\Menu;
use App\Models\User;
use App\Models\Table;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Support\Facades\Hash;


class OrdersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_api_route_order_status_return_ok()
{
    $user1 = User::make([
        'username' => 'chef User',
        'email' => 'chef@example.com',
        'password' => Hash::make('password'),
        'role' => 'chef'
    ]);
    $user1->save(); // บันทึกผู้ใช้ให้กับฐานข้อมูล

    $statusTable = array('available', 'used');
    $table = Table::make([
        'status' => $statusTable[array_rand($statusTable)],
        'user_id' => $user1->id
    ]);
    $table->save(); // บันทึกข้อมูลของโต๊ะให้กับฐานข้อมูล

    $statusOrder = array('pending', 'ordered', 'ready', 'served');
    $orderData = [
        'name' => 'pooh',
        'menu_id' => 1,
        'quantity' => '1', // ให้เป็นจำนวนเต็ม
        'detail' => 'poohpoohpooh',
        'status' => 'ready',
        'table_id' => $table->id,
    ];
    $order = Order::create($orderData); // สร้างคำสั่งใหม่และบันทึกให้กับฐานข้อมูล
    $order = Order::first();

    $response = $this->getJson('api/order/' . $order->id);
    $response->assertStatus(200);
    // $response->assertJsonFragment(['name' => 'pooh']);
}

}
