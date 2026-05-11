<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add unique constraints
        Schema::table('categories', function (Blueprint $table) {
            $table->unique('name');
            $table->unique('order');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->unique(['category_id', 'name']);
            $table->unique(['category_id', 'order']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unique(['category_id', 'order']);
            $table->unique(['category_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['name']);
            $table->dropUnique(['order']);
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropUnique(['category_id', 'name']);
            $table->dropUnique(['category_id', 'order']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['category_id', 'order']);
            $table->dropUnique(['category_id', 'name']);
        });
    }
};