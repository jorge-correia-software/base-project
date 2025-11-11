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
            $table->string('short_description')->nullable()->after('slug');
            $table->string('card_image')->nullable()->after('featured_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_areas', function (Blueprint $table) {
            $table->dropColumn(['short_description', 'card_image']);
        });
    }
};
