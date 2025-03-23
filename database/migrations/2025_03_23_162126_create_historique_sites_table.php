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
        Schema::create('historique_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employe_id')->constrained()->onDelete('cascade'); //Employee concernée
            $table->foreignId('last_site_id')->constrained('sites')->onDelete('set null'); //last Site concerné
            $table->foreignId('new_site_id')->constrained('sites')->onDelete('set null'); //new Site concerné
            $table->date('date_changement'); //date de changement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_sites');
    }
};
