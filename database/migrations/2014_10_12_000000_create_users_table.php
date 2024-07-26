<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('lrn_number')->nullable();
            $table->string('student_number')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type', ['Registrar', 'Admission', 'Student'])->default('Registrar');
            $table->string('phone_number')->nullable();
            $table->string('course', 15)->nullable();
            $table->foreignIdFor(\App\Models\Program::class,'program_id')->nullable();
            $table->string('address')->nullable();
            $table->enum('class_year', ['First Year', 'Second Year', 'Third Year', 'Fourth Year'])->nullable();
            $table->string('image', 225)->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->boolean('deleted_flag')->default(0)->comment('0 == not deleted || deleted');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
