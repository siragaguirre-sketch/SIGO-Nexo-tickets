<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const INDEX_NAME = 'tickets_estado_fecha_index';

    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->index(['estado_workflow', 'fecha_entrada'], self::INDEX_NAME);
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex(self::INDEX_NAME);
        });
    }
};
