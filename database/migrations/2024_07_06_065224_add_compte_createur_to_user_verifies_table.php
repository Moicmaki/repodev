<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompteCreateurToUserVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_verifies', function (Blueprint $table) {
            $table->string('compte_createur')->default('')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('user_verifies', function (Blueprint $table) {
            $table->dropColumn('compte_createur');
        });
    }
}