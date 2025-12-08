<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar_url')->nullable();
            $table->json('skills')->nullable();
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['title','location','bio','avatar_url','skills']);
        });
    }
};
