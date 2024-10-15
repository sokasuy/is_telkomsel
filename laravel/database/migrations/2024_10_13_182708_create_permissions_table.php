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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->index();
            $table->string('role', length: 50);
            $table->foreignId('sidebar_id')->index();
            $table->string('menu_group', length: 100);
            $table->string('menu_name', length: 100);
            $table->string('view', length: 150);
            $table->boolean('create');
            $table->boolean('update');
            $table->boolean('read');
            $table->boolean('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
