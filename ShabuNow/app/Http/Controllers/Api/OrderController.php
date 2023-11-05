<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderWithPrice()
    {
        $orderWithPrice = DB::table('menus')
            ->join('orders', 'orders.menu_id', '=', 'menus.id');
        return $orderWithPrice;
    }

    public function checkOrdered()
    {
        $orders = Order::where('status', '=' , 'ordered')->get();
        return $orders;
    }

    public function show(Order $order)
    {
        $orderWithPrice = $this->orderWithPrice();
        $orders = $orderWithPrice->where('orders.id', '=' , $order->id)->first();
        return $orders;
    }
    public function index(Table $table)
    {
        $orders = $this->orderWithPrice();
        $orders = $orders->where('table_id', '=' , $table->id)->get();
        return $orders;
    }

    public function checkPending(Table $table)
    {
        $orderwithPrice = DB::table('menus')
            ->join('orders', 'orders.menu_id', '=', 'menus.id')
            ->where('orders.table_id', '=' , $table->id)
            ->where('orders.status', '=' , 'pending')
            ->get();
        return $orderwithPrice;
    }


    public function served(Order $order)
    {
        $order->status = 'served';
        $order->save();
        return $order;
    }

    public function sendOrders(Table $table)
    {
        $orders = Order::where('table_id', '=' , $table->id);
        $orders = $orders->where('table_id', '=' , $table->id);
        $orders = $orders->where('status', '=' , 'pending');
        foreach ($orders as $order)
        {
            $order->status = 'ordered';
            $order->save();
        }

        $orders = $this->orderWithPrice();
        $orders = $orders->where('table_id', '=' , $table->id)->get();
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

    public function checkBill(Table $table)
    {
        $orderstobill = Order::where('table_id', '=' , $table->id);
        $user = \App\Models\User::where('id', '=' , $table->user_id)->first();
        foreach ($orderstobill as $order) {
            $history = new History();
            $history->name = $order->name;
            $history->quantity = $order->quantity;
            $history->detail = $order->detail;
            $history->user_id = $user->id;
            $history->save();
            $history->refresh();
            $order->delete();
        }

        $table->status = 'available';
        $table->user_id = null;
        $table->save();

        $user->tableNumber = null;
        $user->save();

        $historys = History::where('user_id', '=' , $user->id)->get();
        return [$historys,$user, $table];
    }
}
