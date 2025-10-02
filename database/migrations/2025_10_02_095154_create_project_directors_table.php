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
        Schema::create('project_directors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects', 'id')->onDelete('cascade');
            $table->foreignId('director_id')->constrained('directors', 'id')->onDelete('cascade');
            $table->decimal('contribution', 10, 2)->default(0);
            $table->integer('profit_percentage')->default(0);
            $table->date('date_of_join')->nullable();
            $table->foreignId('type')->constrained('extras', 'id')->onDelete('cascade');
            $table->decimal('installment_amount', 10, 2)->nullable();
            $table->integer('number_of_installments')->nullable();
            $table->date('installment_start_date')->nullable();
            $table->date('installment_end_date')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('created_by')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users', 'id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_directors');
    }
};
