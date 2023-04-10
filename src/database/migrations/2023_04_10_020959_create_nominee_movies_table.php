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
        Schema::create('nominee_movie', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("oscarawardmovie_id");
            $table->foreign('oscarawardmovie_id')->references('id')->on('oscar_award_movie')->onDelete('cascade');

            $table->string("movie_id");
            $table->foreign('movie_id')->references('id')->on('movie');

            $table->boolean("winner")->default(false);

            $table->unique(['oscarawardmovie_id', 'movie_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominee_movie');
    }
};
