<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('asociados', function (Blueprint $table) {
            //
            // DB::table('asociados')
            //     ->whereNotIn('genero', ['M', 'F'])
            //     ->update(['genero' => 'O']);

            // Schema::table('asociados', function (Blueprint $table) {
            //     $table->enum('genero', ['M', 'F', 'O'])->default('O')->change();
            // });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        DB::table('asociados')->where('genero', 'O')->update(['genero' => 'M']);
        Schema::table('asociados', function (Blueprint $table) {
            // $table->enum('genero', ['M', 'F'])->default('M')->change();
        });
    }
};
