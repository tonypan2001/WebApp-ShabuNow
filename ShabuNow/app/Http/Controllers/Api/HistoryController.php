<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\User;

class HistoryController extends Controller
{
    public function show(User $user)
    {
        $histories = History::where('user_id', $user->id)->get();
        return $histories;
    }
}
