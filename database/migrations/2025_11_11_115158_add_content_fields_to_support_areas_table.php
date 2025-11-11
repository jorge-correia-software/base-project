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
        Schema::table('support_areas', function (Blueprint $table) {
            $table->text('content')->nullable()->after('description');
            $table->string('featured_image')->nullable()->after('background_image_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_areas', function (Blueprint $table) {
            $table->dropColumn(['content', 'featured_image']);
        });
    }
};
