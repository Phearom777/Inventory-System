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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id'); // Nullable for purchases not linked to a supplier
            $table->unsignedBigInteger('product_id'); // Nullable for purchases not linked to a supplier
            $table->integer('qty');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->text('description')->nullable(); 
            $table->string('status'); // e.g., pending, completed, cancelled
            $table->string('payment'); // e.g., pending, completed, cancelled
            $table->date('purchase_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('supplier_id')
            ->references('id')->on('suppliers')
            ->onDelete('cascade');

            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
