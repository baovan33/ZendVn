<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_tags', function (Blueprint $table) {
                $table
                    ->foreign('product_id')
                    ->references('id')
                    ->on('products')->onDelete('cascade');

                $table
                    ->foreign('tag_id')
                    ->references('id')
                    ->on('tags')->onDelete('cascade');
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_tags', function (Blueprint $table) {
            $table->dropForeign('product_tag_product_id_foreign');
            $table->dropForeign('product_tag_tag_id_foreign');
        });
    }
}
