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
            $table->boolean('showed_in_main_slider')->index()->default(0);
            $table->string('name')->index()->unique();
            $table->string('alias')->index()->unique();
            $table->decimal('price', 10, 2)->index();
            $table->text('describ')->nullable();
            $table->string('short_image')->nullable();
            $table->float('current_reting', 1, 1)->nullable();
            $table->unsignedSmallInteger('amount')->default(0);
            $table->unsignedTinyInteger('discont')->nullable();

            $table->foreignId('directory_id')->constrained('directories');
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
