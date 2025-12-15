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
        Schema::table('categories', function (Blueprint $table) {
            // Menambahkan kolom 'name' (string, wajib diisi)
            $table->string('name')->after('id'); 
            
            // Menambahkan kolom 'slug' (string unik, wajib diisi)
            $table->string('slug')->unique(); 
            
            // Menambahkan kolom 'image' (string, boleh null)
            // Panjang 255 cukup untuk menyimpan path atau URL gambar.
            $table->string('image', 255)->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Menghapus kolom jika kita membatalkan migrasi (rollback)
            $table->dropColumn(['name', 'slug', 'image']);
        });
    }
};