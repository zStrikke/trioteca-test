<?php

use App\Enums\DwellingStatus;
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
        Schema::create('dwellings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('address');
            $table->integer('price')->nullable();
            $table->text('comments')->nullable();
            $table->enum('status', array_column(DwellingStatus::cases(), 'value'))->default(DwellingStatus::Requested->value);
            $table->unsignedBigInteger('user_id');
 
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dwellings');
    }
};
