<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Permet des crédits / coefficients décimaux (0.5, 1.5, 2.5, ...).
     * ALTER en SQL brut pour éviter la dépendance doctrine/dbal.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE matieres MODIFY coefficient DECIMAL(5,2) NOT NULL');
        DB::statement('ALTER TABLE matieres MODIFY credit DECIMAL(5,2) NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE matieres MODIFY coefficient INT NOT NULL');
        DB::statement('ALTER TABLE matieres MODIFY credit INT NOT NULL');
    }
};
