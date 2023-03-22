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
        Schema::create('nominee_artist', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("oscarawardartist_id");
            $table->foreign('oscarawardartist_id')->references('id')->on('oscar_award_artist')->onDelete('cascade');

            $table->string("artist_id");
            $table->foreign('artist_id')->references('id')->on('artist')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominee_artist');
    }
};
