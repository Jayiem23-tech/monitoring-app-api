<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coverages', function (Blueprint $table) {
            $table->id();

            $table->string("bp_number")->nullable();
            $table->string("batch")->nullable();
            $table->string("licience")->nullable(); 

            $table->integer("acct_id")->unsigned();
            $table->date("asp_start_date");
            $table->date("asp_end_date");
            $table->string("asp_price")->nullable();
            $table->string("status")->nullable();
            $table->string("type_of_support")->nullable();
            $table->string("sap_system_audit")->nullable();
            $table->string("software_audit")->nullable();
            $table->string("type_of_server")->nullable();
            $table->string("server_av")->nullable();
            $table->string("client_av")->nullable();
            $table->string("office_365")->nullable();
            $table->string("firewall")->nullable();

            $table->string("backup_storage")->nullable();
            $table->string("ups")->nullable();
            $table->string("veritas")->nullable();
            $table->string("infra_recommendations")->nullable();
            $table->string("product_inquiry")->nullable();
            $table->string("client_type")->nullable();
            $table->string("remarks")->nullable();
            $table->string("software_version")->nullable(); 
        
            $table->timestamps();
            
            $table->foreign("acct_id")->references("id")->on("accounts")->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coverages');
    }
}
