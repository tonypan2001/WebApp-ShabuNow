<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    // 'menu_id' => $number,
    //         'name' => $name,
    //         'quantity' => fake()->numberBetween(1,10),
    //         'detail' => fake()->realTextBetween(120,200,2),
    //         'status' => $status[array_rand($status)],
    //         'table_id' => fake()->numberBetween(1,20),
    protected $fillable = ['name', 'detail','quantity','status'];



    public function menus() : HasMany
    {
        return $this->hasMany(Menu::class);
    }

    // set time format
    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d - H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d - H:i:s');
    }
}
