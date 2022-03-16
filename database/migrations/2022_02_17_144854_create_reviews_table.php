<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->string('author_name')->nullable();
            $table->string('author_email')->nullable();
            $table->integer('rating')->nullable();
            $table->longText('content');
            $table->text('dignity')->nullable();
            $table->text('limitations')->nullable();
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('is_deal_confirmed')->default(0);

//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('set null');
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
        Schema::dropIfExists('reviews');
    }
}
