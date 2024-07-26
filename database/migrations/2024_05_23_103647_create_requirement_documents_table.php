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
        Schema::create('requirement_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Requirement::class,'requirement_id');
            $table->foreignIdFor(\App\Models\Service::class,'service_id');
            $table->foreignIdFor(\App\Models\User::class,'student_id');
            $table->foreignIdFor(\App\Models\Document::class,'document_id');
            $table->string('image')->nullable();
            $table->boolean('status')->default(0)->comment('0 == not selected || selected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirement_documents');
    }
};
