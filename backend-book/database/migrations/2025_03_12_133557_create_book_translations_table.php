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
        Schema::create('book_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('translatable'); //handle book.category translations
            $table->string('language_code',5);
            $table->string('name');
            $table->string('desc')->nullable();
            $table->softDeletes(); // Add this line
            $table->timestamps();

            $table->unique(['translatable_type' , 'translatable_id' , 'language_code'] , 'translatable_lang_unique' );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_translations');
    }
};
