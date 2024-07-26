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
        Schema::create('requirement_remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Requirement::class,'requirement_id');
            $table->foreignIdFor(\App\Models\Service::class,'service_id');
            $table->foreignIdFor(\App\Models\User::class,'user_id');
            $table->enum('type',['Store','Update'])->default('Store');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirement_remarks');
    }
};
