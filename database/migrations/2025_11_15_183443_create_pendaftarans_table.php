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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->tinyInteger('semester');
            $table->decimal('ipk', 3, 2);
            $table->foreignId('jenis_beasiswa_id')->nullable()->constrained('jenis_beasiswa')->nullOnDelete();
            $table->string('file_path')->nullable();
            $table->string('status_ajuan')->default('belum diverifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
