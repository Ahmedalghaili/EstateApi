<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->enum('type', ['house', 'apartment']);
        $table->string('address');
        $table->decimal('size', 8, 2);  // الحجم بالمتر المربع أو القدم المربع
        $table->integer('bedrooms');
        $table->decimal('latitude', 10, 8);
        $table->decimal('longitude', 10, 8);
        $table->decimal('price', 10, 2);
        $table->timestamps();
    });

    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
