<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('details', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')
                ->after('contact_id')->comment('types');
            $table->string('type_title')->nullable()
                ->after('type_id')->comment('types');

            $table->foreign('type_id')->references('id')->on('types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });

        // Insert some stuff
        DB::table('types')->insert(
            [
                [
                    'id' => 1,
                    'title' => 'mobile'
                ],
                [
                    'id' => 2,
                    'title' => 'phone'
                ],
                [
                    'id' => 3,
                    'title' => 'email'
                ],
                [
                    'id' => 4,
                    'title' => 'instagram'
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('details', function (Blueprint $table) {
            $table->dropColumn(['type_id', 'type_title']);
        });
    }
};
