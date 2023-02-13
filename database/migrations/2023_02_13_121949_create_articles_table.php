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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();    
			$table->bigIncrements('a');    
			$table->bigInteger('b');    
			$table->decimal('c');    
			$table->double('d');    
			$table->increments('e');    
			$table->integer('f');    
			$table->mediumInteger('g');    
			$table->smallInteger('h');    
			$table->tinyInteger('i');    
			$table->date('j');    
			$table->dateTime('k');    
			$table->time('l');    
			$table->timestamp('m');    
			$table->timestamps('n');    
			$table->nullableTimestamps('o');    
			$table->char('p');    
			$table->string('q');    
			$table->mediumText('r');    
			$table->longText('s');    
			$table->text('t');    
			$table->binary('u');    
			$table->boolean('v');    
			$table->float('x');    
			$table->json('y');    
			$table->jsonb('z');    
			$table->morphs('aa');    
			$table->softDeletes('bb');            
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
        Schema::dropIfExists('articles');
    }
};