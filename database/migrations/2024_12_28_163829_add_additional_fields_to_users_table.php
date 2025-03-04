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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->unique()->nullable()->after('id');
            $table->string('tempat_lahir')->nullable()->after('name');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->text('address')->nullable()->after('tanggal_lahir');
            $table->string('contact')->nullable()->after('address');
            $table->string('agama')->nullable()->after('contact');
            $table->string('image')->nullable()->after('agama');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nip', 'tempat_lahir', 'tanggal_lahir', 'address', 'contact', 'agama', 'image']);
        });
    }
};
