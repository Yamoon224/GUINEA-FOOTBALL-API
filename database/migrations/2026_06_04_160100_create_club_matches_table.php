<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('club_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->string('category');
            $table->string('opponent');
            $table->string('competition');
            $table->date('match_date');
            $table->string('match_time')->nullable();
            $table->string('day_label')->nullable();
            $table->string('venue');
            $table->string('stadium')->nullable();
            $table->boolean('is_home')->default(true);
            $table->string('status')->default('scheduled');
            $table->unsignedTinyInteger('club_score')->nullable();
            $table->unsignedTinyInteger('opponent_score')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('club_matches');
    }
};
