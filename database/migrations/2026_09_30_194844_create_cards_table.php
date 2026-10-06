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
        Schema::create('cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('oracle_id')->nullable(true);
            $table->string('card_name');
            $table->decimal('cmc');
            $table->json('color_identity')->nullable(true);
            $table->string('type_line');
            $table->string('oracle_text', 2048)->nullable(true);
            $table->string('power')->nullable(true);
            $table->string('toughness')->nullable(true);
            $table->string('loyalty')->nullable(true);
            $table->string('artist')->nullable(true);
            $table->date('released_at');
            $table->string('set_name');
            $table->string('normal_image_url')->nullable(true);
            $table->decimal('usd_price')->nullable(true);
            $table->decimal('eur_price')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
