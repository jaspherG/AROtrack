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
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class,'user_id');
            $table->foreignIdFor(\App\Models\User::class,'student_id');
            $table->foreignIdFor(\App\Models\Service::class,'service_id'); // service type
            $table->enum('class_year', ['First Year', 'Second Year', 'Third Year', 'Fourth Year']);
            $table->string('academic_year', 20);
            $table->string('course', 15);
            $table->boolean('is_new_student')->default(0)->comment(' 0 = new , 1 = old');
            $table->foreignIdFor(\App\Models\Program::class,'program_id');
            $table->enum('status',['Completed','Deficiency'])->default('Deficiency');
            $table->boolean('deleted_flag')->default(0)->comment('0 == not deleted || deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
