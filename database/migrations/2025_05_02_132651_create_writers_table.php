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
 
            Schema::create('writers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('subsection_id')->constrained()->cascadeOnDelete();
                $table->string('image')->nullable();
                $table->json('bio')->nullable();
                $table->timestamps();
            });
            
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writers');
    }
};
