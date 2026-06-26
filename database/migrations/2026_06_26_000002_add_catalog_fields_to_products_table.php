<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('marked_price', 12, 2)->default(0)->after('price');
            $table->unsignedInteger('quantity')->default(0)->after('marked_price');
            $table->string('subcategory')->nullable()->after('category_id');
            $table->text('meta_description')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['marked_price', 'quantity', 'subcategory', 'meta_description']);
        });
    }
};
