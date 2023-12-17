<?php

use App\Models\User;
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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->float("value", 9, 2)->nullable();
            $table->date("entry")->nullable();
            $table->foreignIdFor(User::class);
            $table->unsignedBigInteger('from')->nullable();
            $table->unsignedBigInteger('to')->nullable();
            $table->unsignedBigInteger('prev')->nullable();
            $table->unsignedBigInteger('next')->nullable();
            $table->timestamps();

            $table->foreign('from')->references('id')->on('sources');
            $table->foreign('to')->references('id')->on('sources');
            $table->foreign('prev')->references('id')->on('bills');
            $table->foreign('next')->references('id')->on('bills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
