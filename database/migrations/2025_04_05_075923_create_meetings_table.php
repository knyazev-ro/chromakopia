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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->unsignedTinyInteger('format_type');
            $table->foreignId('chariman_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('secretaty_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('branch_id')->constrained('branches');
            $table->unsignedTinyInteger('director_type')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
