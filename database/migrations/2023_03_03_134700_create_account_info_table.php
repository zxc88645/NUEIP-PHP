<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {

    public function up(): void
    {
        Schema::create('account_info', function (Blueprint $table) {
            $table->id();
            $table->string('account')->unique();
            $table->string('name');
            $table->tinyInteger('gender');
            $table->date('birthday');
            $table->string('email')->unique();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_info');
    }
};