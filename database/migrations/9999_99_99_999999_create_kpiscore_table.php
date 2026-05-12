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
        Schema::create('kpiscore', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kpiquestion');
            $table->unsignedBigInteger('id_user');
            $table->integer('skor');
            $table->string('bukti');
            $table->string('keterangan');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_kpiquestion')
                   ->references('id')
                   ->on('kpiquestions')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');

             $table->foreign('id_user')
                   ->references('id')
                   ->on('users')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpiscore');
    }
};
