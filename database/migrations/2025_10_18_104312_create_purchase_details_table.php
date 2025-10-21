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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->onDelete('cascade');
            $table->foreignId('hsn_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->default(0);
            $table->integer('qty')->default(0);
            $table->date('expiry_date')->nullable();
            $table->string('batch_number', 25)->nullable();
            $table->decimal('purchase_price_qty', 8, 2)->default(0);
            $table->decimal('selling_price_qty', 8, 2)->default(0);
            $table->decimal('total', 9, 2)->default(0);
            $table->integer('qty_returned')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
