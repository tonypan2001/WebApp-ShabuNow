<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Mass Assignment ควรใส่ "name" ลงในอาร์เรย์ "fillable" ในโมเดล Menu เพื่ออนุญาตให้มีการกำหนดค่าผ่าน Mass Assignment ได้แบบปลอดภัย.
    protected $fillable = ['name', 'description','price','status','category_id'];

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