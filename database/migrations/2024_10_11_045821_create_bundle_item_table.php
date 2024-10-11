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
        Schema::create('bundle_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_bundle_id')->constrained()->onDelete('cascade'); // Foreign key to item_bundles table
            $table->string('name_bundle'); // Item name of bundle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bundle_item');
    }
};
