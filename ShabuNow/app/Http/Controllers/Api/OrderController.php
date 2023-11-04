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
        $orderWithPrice = $this->orderWithPrice();
        $orders = $orderWithPrice->where('orders.id', '=' , $order->id);
        return $orders;
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
        $orders = Order::where('table_id', '=' , $table->id)->get();
        $orders = $orders->where('table_id', '=' , $table->id);
        $orders = $orders->where('status', '=' , 'pending');
        foreach ($orders as $order)
        {
            $order->status = 'ordered';
            $order->save();
        }

        $orders = $this->orderWithPrice();
        $orders = $orders->where('table_id', '=' , $table->id);
        return $orders;
    }

    public function store(Request $request, Table $table)
    {
        $request->validate([
                'menu_id' => ['required'],
                'quantity' => ['required','integer','min:1','max:100'],
            ]);

        $order = new Order();

        $order->menu_id = $request->get('menu_id');
        $order->quantity = $request->get('quantity');
        $menu = Menu::find($request->get('menu_id'));
        $order->name = $menu->name;
        $order->table_id = $table->id;
        $order->status = 'pending';

        $order->save();
        $order->refresh();

        return $order;
    }

}
