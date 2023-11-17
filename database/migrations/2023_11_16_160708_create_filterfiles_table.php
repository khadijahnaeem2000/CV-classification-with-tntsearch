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
        Schema::create('filterfiles', function (Blueprint $table) {
            $table->id();
            $table->string('FilterName')->nullable();
            $table->string('Status')->nullable();
            $table->string('ClassifyTypeOne')->nullable();
            $table->string('ClassifyTypeTwo')->nullable();
            $table->string('FolderNameOne')->nullable();
            $table->string('FolderNameTwo')->nullable();
            $table->string('Guest')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filterfiles');
    }
};
