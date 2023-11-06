<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    // $table->id();
    //         $table->timestamps();
    //         $table->string('name')->nullable();
    //         $table->foreignIdFor(\App\Models\Menu::class)->nullable(); //menu_id (fk)
    //         $table->string('detail')->nullable();
    //         $table->integer('quantity');
    //         $table->enum('status', ['pending','ordered','ready','served']);
    //         $table->foreignIdFor(\App\Models\Table::class)->nullable(); //table_id (fk)

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