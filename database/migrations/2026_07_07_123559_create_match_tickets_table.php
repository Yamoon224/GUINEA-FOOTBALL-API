<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('match_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_match_id')->constrained('club_matches')->cascadeOnDelete();
            $table->string('type');
            $table->string('price');
            $table->unsignedInteger('available');
            $table->unsignedInteger('total');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_tickets');
    }
};
