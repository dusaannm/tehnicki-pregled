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
        Schema::create('uslugas', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 120);
            $table->text('opis')->nullable();
            $table->decimal('cena', 8, 2);
            $table->integer('trajanje_min')->default(30);
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uslugas');
    }
};
