<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        return Table::get();
    }

    public function count()
    {
        return Table::count();
    }

    public function show(Table $table)
    {
        return $table;
    }

    public function update(Request $request, Table $table)
    {
        $table->status = $request->get('status');
        $table->save();
        return $table;
    }

    public function store()
    {
        $table = new Table();
        $table->id = Table::count() + 1;
        $table->status = 'available';
        $table->save();
    }

    public function destroy()
    {
        $tableToRemove = Table::count();
        $table = Table::find($tableToRemove);
        $table->delete();
    }

    public function checkIn(Request $request)
    {
        $table = Table::where('id', $request->get("tableid"))->first();
        $user = User::where('id', $request->get("userid"))->first();

        $table->user_id = $user->id;
        $user->tableNumber = $table->id;

        $table->status = 'used';

        $table->save();
        $user->save();

        return $table;
    }

}
