<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderWithPrice()
    {
        $orderWithPrice = DB::table('menus')
            ->join('orders', 'orders.menu_id', '=', 'menus.id')
            ->get();
        return $orderWithPrice;
    }

    public function show(Order $order)
    {
        return $order;
    }
    public function index(Table $table)
    {
        $orders = $this->orderWithPrice();
        $orders = $orders->where('table_id', '=' , $table->id);
        return $orders;
    }

    public function checkPending(Table $table)
    {
        $orders = $this->orderWithPrice();
        $orders = $orders->where('table_id', '=' , $table->id);
        $orders = $orders->where('status', '=' , 'pending');
        return $orders;
    }

    public function sendOrders(Table $table)
    {
        $orders = $this->orderWithPrice();
        $orders = $orders->where('table_id', '=' , $table->id);
        $orders = $orders->where('status', '=' , 'pending');
        foreach ($orders as $order)
        {
            $order->status = 'ordered';
            $order->save();
        }
        return $orders;
    }

    public function create(Request $request, Table $table)
    {
        $order = new Order();

        $order->menu_id = $request->get('menu_id');
        $order->quantity = $request->get('quantity');
        $order->table_id = $table->id();
        $order->status = 'ordered';

        $order->save();
    }

}
