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
        Schema::disableForeignKeyConstraints();

        Schema::create('termins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('usluga_id')->constrained();
            $table->foreignId('vozilo_id')->constrained();
            $table->date('datum');
            $table->time('vreme');
            $table->enum('status', ['pending', 'approved', 'completed', 'cancelled', 'canceled', 'rejected', 'done', 'na_cekanju', 'potvrdjen'])->default('pending');
            $table->text('napomena')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termins');
    }
};
