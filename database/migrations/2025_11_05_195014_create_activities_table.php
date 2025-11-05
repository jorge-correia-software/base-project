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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('icon')->default('Rocket');
            $table->string('image_url');
            $table->date('date');
            $table->enum('company', ['Elevator', 'BRT'])->default('BRT');
            $table->string('duration')->nullable();
            $table->string('location')->nullable();
            $table->string('price')->default('Free');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
