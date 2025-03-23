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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('matricule')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('adresse')->nullable();
            $table->date('birth')->nullable();
            $table->string('cv')->nullable(); //save CV
            $table->string('picture')->nullable(); //save picture
            $table->string('rib')->nullable(); //save RIB
            //foreigns Keys
            $table->foreignId('site_id')->contrained()->onDelete('cascade');
            $table->foreignId('grade_id')->contrained()->onDelete('cascade');
            $table->foreignId('work_id')->contrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
