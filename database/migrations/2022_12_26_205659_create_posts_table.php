<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('extract');
            $table->longText('body');
            $table->enum('status', [Post::BORRADOR, Post::PUBLICADO])->default(Post::BORRADOR);
            /*$table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');

            $table->foreign('category_id')
                ->on('categories')
                ->references('category_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->on('users')
                ->references('user_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');*/

            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
