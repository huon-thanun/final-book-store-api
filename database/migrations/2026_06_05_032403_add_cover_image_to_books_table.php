<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // 🌟 បន្ថែម Column សម្រាប់រក្សាទុកឈ្មោះរូបភាព (អនុញ្ញាតឱ្យ Nullable ក្នុងករណីអត់មានរូប)
            $table->string('cover_image')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // សម្រាប់លុប Column នេះវិញប្រសិនបើមានការ Rollback
            $table->dropColumn('cover_image');
        });
    }
};
