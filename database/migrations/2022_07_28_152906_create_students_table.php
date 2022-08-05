<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11)->unique(true);
            $table->string('company')->nullable(true);
            $table->string('telephone')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->enum('category', ['Estudante', 'Profissional', 'Associado']);
            $table->boolean('paid_out')->default(false);
            $table->foreignId('address_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
};
