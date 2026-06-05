<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // បន្ថែម Column Foreign Key ទាំងពីរ និងភ្ជាប់ទៅកាន់តារាងដើម
            $table->foreignId('category_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->after('category_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // លុប Foreign Key និង Column ទាំងពីរនេះវិញពេល Rollback
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
};