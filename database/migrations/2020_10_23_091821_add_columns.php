<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });
        Schema::table('account_groups', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });
        Schema::table('document_types', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropForeign('accounts_company_id_foreign');
            $table->dropColumn('company_id');
        });
        Schema::table('account_groups', function (Blueprint $table) {
            $table->dropForeign('account_groups_company_id_foreign');
            $table->dropColumn('company_id');
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign('documents_company_id_foreign');
            $table->dropColumn('company_id');
        });
        Schema::table('document_types', function (Blueprint $table) {
            $table->dropForeign('document_types_company_id_foreign');
            $table->dropColumn('company_id');
        });
    }
}
