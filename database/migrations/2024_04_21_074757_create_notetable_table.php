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
        Schema::create('notetable', function (Blueprint $table) {
            $table->unsignedBigInteger('note_id')->comment('notes');
            $table->unsignedBigInteger('notetable_id')->comment('companies and contacts');
            $table->string('notetable_type')->comment('companies and contacts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notetable');
    }
};
