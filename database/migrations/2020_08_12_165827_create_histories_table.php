<?php

use App\Models\History;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(History::FIELD_CURRENCY_ID);
            $table->integer(History::FIELD_VALUE);
            $table->integer(History::FIELD_NOMINAL);
            $table->date(History::FIELD_DATE);

            $table->foreign(History::FIELD_CURRENCY_ID)
                ->references('id')
                ->on('currencies')
                ->onDelete('cascade');
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
        Schema::dropIfExists('histories');
    }
}
