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
       Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->decimal('total_amount', 10, 2);
        $table->string('payment');
        $table->string('status');
        $table->date('sale_date');
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
    
    
};
