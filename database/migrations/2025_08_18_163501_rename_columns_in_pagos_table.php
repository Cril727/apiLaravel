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
        Schema::table('pagos', function (Blueprint $table) {
            //
            $table->renameColumn('valorPago', 'valor_pago');
            $table->renameColumn('fechaPago', 'pagado_el');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            //
            $table->renameColumn('valor_pago', 'valorPago');
            $table->renameColumn('pagado_el', 'fechaPago');
        });
    }
};
