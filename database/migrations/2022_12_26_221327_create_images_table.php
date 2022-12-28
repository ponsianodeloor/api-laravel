<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->string('url');

            /*$table->unsignedInteger('imageable_id');
            $table->string('imageable_type');*/

            $table->morphs('imageable');

            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};
