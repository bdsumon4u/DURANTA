<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->foreignId('seller_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('sku');
            $table->string('name')->index();
            $table->string('slug')->nullable()->unique();
            $table->longText('description');

            $table->integer('price')->unsigned();
            $table->integer('discount_amount')->unsigned();
            $table->string('discount_type', 15);
            $table->timestamp('discount_from')->nullable();
            $table->timestamp('discount_till')->nullable();

            $table->integer('commission_amount')->unsigned()->default(0);
            $table->string('commission_type', 15)->default('fixed');
            $table->integer('commission')->unsigned()->default(0);

            $table->boolean('stock_track')->default(0);
            $table->integer('stock_count')->default(0);
            $table->string('pickup_point')->nullable();

            $table->string('status', 15)->default('pending');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['seller_id', 'sku']);
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
}
