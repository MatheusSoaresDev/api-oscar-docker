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
        Schema::create('oscar_award_movie', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("oscar_id");
            $table->foreign('oscar_id')->references('id')->on('oscar')->onDelete('cascade');

            $table->string("awardmovie_id");
            $table->foreign('awardmovie_id')->references('id')->on('award_movie')->onDelete('cascade');

            $table->unique(['oscar_id', 'awardmovie_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oscar_award_movie');
    }
};
