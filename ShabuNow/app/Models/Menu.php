<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    // 'name' => $foodNames[array_rand($foodNames)],
    //         'category_id' => Category::find(rand(1, 5)),
    //         'description' => fake()->realTextBetween(120,200,2),
    //         'status' => $status[array_rand($status)],
    //         'price' => fake()->numberBetween(20,200),

    protected $fillable = ['name','description','status','price','category_id'];

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
