<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // 🌟 បន្ថែម Field stock ជាប្រភេទ Integer និងកំណត់តម្លៃលំនាំដើមស្មើ 0
            $table->integer('stock')->default(0)->after('price'); 
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }
};