<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer("owner_id")->unsigned();
            $table->string("acct_creation_date")->nullable();
            $table->string("acct_creation_time")->nullable();
            $table->string("acct_name")->nullable();
            $table->string("acct_type")->nullable();
            $table->string("acct_updated_date")->nullable();
            $table->string("branch")->nullable();
            $table->string("reseller")->nullable();
            $table->string("industry")->nullable();
            $table->string("size")->nullable();
            $table->string("address")->nullable();
            $table->string("contact_person")->nullable(); 
            $table->string("phone")->nullable(); 
            $table->string("email")->nullable();  
            $table->timestamps();

            $table->foreign("owner_id")->references("id")->on("owners")->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
