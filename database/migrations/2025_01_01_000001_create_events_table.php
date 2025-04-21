<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('users');
            $table->string('title');
            $table->text('short_description');
            $table->text('description')->nullable();
            $table->string('location');
            $table->dateTime('starts_at');
            $table->boolean('paid')->default(false);
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}