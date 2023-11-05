<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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

    public function show(string $id)
    {
        return Table::find($id);
    }

    public function update(Request $request, string $id)
    {
        $table = Table::find($id);
        $table->status = $request->get('status');
        $table->save();
    }

    public function destroy(string $id)
    {
        $table = Table::find($id);
        $table->delete();
    }
}
