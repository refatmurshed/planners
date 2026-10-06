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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('member_id')->nullable();
        $table->string('receipt_no')->unique();
        $table->date('payment_date');
        $table->unsignedBigInteger('receiver')->nullable();
        $table->integer('months');
        $table->decimal('monthly_amount', 10, 2)->default(0);
        $table->decimal('total_amount', 10, 2)->default(0);
        $table->text('paid_months')->nullable();
        $table->string('pdf_file')->nullable();
        $table->string('receipt_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
