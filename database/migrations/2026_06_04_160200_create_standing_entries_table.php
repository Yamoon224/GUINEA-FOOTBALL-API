<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('standing_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->string('competition');
            $table->string('category');
            $table->string('season');
            $table->unsignedSmallInteger('position');
            $table->string('team_name');
            $table->unsignedSmallInteger('played')->nullable();
            $table->unsignedSmallInteger('wins')->nullable();
            $table->unsignedSmallInteger('draws')->nullable();
            $table->unsignedSmallInteger('losses')->nullable();
            $table->unsignedSmallInteger('goals_for')->nullable();
            $table->unsignedSmallInteger('goals_against')->nullable();
            $table->integer('points')->default(0);
            $table->boolean('is_club')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('standing_entries');
    }
};
