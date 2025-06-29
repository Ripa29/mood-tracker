<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mood_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('mood', ['Happy', 'Sad', 'Angry', 'Excited', 'Calm', 'Stressed', 'Anxious', 'Content']);
            $table->text('note')->nullable();
            $table->date('entry_date');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'entry_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('mood_entries');
    }
};
