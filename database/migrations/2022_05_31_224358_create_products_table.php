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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("price");
            $table->mediumText("description");
            $table->string("quantity");
            $table->string("tags")->nullable();
            $table->foreignId("category_id")->constrained();
            $table->foreignId("special_category_id")->constrained();
            $table->foreignId("supplier_id")->constrained();
            $table->string("product_image");
            $table->string("verified");
            $table->integer("rating");
            $table->integer("review");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
