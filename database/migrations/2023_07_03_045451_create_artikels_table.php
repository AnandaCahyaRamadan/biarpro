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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi');
            $table->string('kabupaten')->nullable();
            $table->string('judul');
            $table->string('keyword')->nullable();
            $table->string('kata_pembuka');
            $table->text('artikel');
            $table->string('keyword_tanya')->nullable();
            $table->string('keyword_terkait')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->string('history');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
