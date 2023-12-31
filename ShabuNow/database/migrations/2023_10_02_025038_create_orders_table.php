<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->foreignIdFor(\App\Models\Menu::class); //menu_id (fk)
            $table->string('detail')->nullable();
            $table->integer('quantity');
            $table->enum('status', ['pending','ordered','ready','served']);
            $table->foreignIdFor(\App\Models\Table::class); //table_id (fk)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
