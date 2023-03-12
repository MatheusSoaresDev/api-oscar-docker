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
        Schema::create('oscar', static function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("edition")->unique();
            $table->string("local");
            $table->date("date");
            $table->string("city");
            $table->year("year")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oscars');
    }
};
