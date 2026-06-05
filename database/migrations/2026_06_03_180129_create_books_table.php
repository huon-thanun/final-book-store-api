<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // BigIncrements, Primary Key
            $table->string('title'); // Not Null
            $table->string('author'); // Not Null
            $table->double('price'); // Not Null
            $table->text('description')->nullable(); // Nullable
            $table->timestamps(); // created_at និង updated_at (Default)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};