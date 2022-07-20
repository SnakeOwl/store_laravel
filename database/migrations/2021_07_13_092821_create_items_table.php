<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index()->unique();
            $table->string('alias')->index()->unique();
            $table->decimal('price', 10, 2)->index();
            $table->text('description');
            $table->string('short_image')->nullable();
            $table->float('current_reting', 1, 1)->default(0);
            $table->unsignedSmallInteger('amount')->default(1);
            $table->unsignedTinyInteger('discount')->default(0)->index();
            $table->boolean('new')->index()->default(1);
            $table->boolean('hit')->index()->default(0);

            $table->foreignId('category_id')->constrained('categories');

            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
