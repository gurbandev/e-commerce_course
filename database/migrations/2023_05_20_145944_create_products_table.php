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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->string('tags')->nullable();
            $table->string('qty');
            $table->text('short_descp');
            $table->text('long_descp');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('thambnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->Integer('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
