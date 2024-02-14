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
        Schema::create('files', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 200);
            $table->string('extension');
            $table->integer('duenio')->unsigned();
            $table->foreign('duenio')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('fecha_creacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
