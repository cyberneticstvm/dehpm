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
        Schema::create('manufacture_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address')->nullable();
            $table->enum('type', ['Manufacturer', 'Supplier']);
            $table->foreignId('created_by')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users', 'id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufacture_suppliers');
    }
};
