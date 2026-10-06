<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // subscription amount
            $table->decimal('amount', 10, 2);

            // system month (for filtering)
            // example: 2026-01
            $table->string('month', 7);

            // human readable month
            // example: January 2026
            $table->string('month_label');

            // due date (actual payment deadline)
            $table->date('due_date');

            $table->date('payment_date')->nullable();
            $table->string('receiver')->nullable();

            // payment status
            $table->tinyInteger('status')->default(0); // 0 = pending, 1 = paid

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
