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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('subject');
            $table->longText('description');
            $table->date('deadline');
            $table->integer('min_bid');
            $table->integer('max_bid')->default(0);
            $table->integer('deal_bid');
            $table->longText('notes')->nullable();
            $table->enum('payment_status' , ['down_payment','paid','unpaid']);
            $table->enum('project_status',['applied','bid','proccess','completed','revision']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
