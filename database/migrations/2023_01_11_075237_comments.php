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
        
        Schema::create('comments',function(Blueprint $column ){
            $column->id();
            $column->longText('comment')->nullable();
            $column->text('pic')->nullable();
            $column->foreignId('post_id')->constrained('posts');
            $column->foreignId('author_id')->constrained('users');
            $column->timestamps();

        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
