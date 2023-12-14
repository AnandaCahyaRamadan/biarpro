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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('no_personal')->nullable();
            $table->string('no_bisnis')->nullable();
            $table->string('link_website')->nullable();
            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('kategori_bisnis_id')->nullable();
            $table
            ->foreign('kategori_bisnis_id')
            ->references('id')
            ->on('kategori_bisnis');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('affiliate_code')->nullable();
            $table->string('refferal_code')->nullable();
            $table->integer('refferal_count')->nullable();
            $table->integer('member')->default(1);
            $table->unsignedBigInteger('parent')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
