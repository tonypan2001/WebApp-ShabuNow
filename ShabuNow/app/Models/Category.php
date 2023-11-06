<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Mass Assignment ควรใส่ "name" ลงในอาร์เรย์ "fillable" ในโมเดล Menu เพื่ออนุญาตให้มีการกำหนดค่าผ่าน Mass Assignment ได้แบบปลอดภัย.
    protected $fillable = ['name'];

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
