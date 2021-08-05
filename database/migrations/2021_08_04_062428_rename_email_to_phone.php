<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEmailToPhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (['users', 'admins', 'sellers'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->renameColumn('email', 'phone');
                $table->renameColumn('email_verified_at', 'phone_verified_at');
            });
        }
        Schema::table('password_resets', function (Blueprint $table) {
            $table->renameColumn('email', 'phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (['users', 'admins', 'sellers'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->renameColumn('phone', 'email');
                $table->renameColumn('phone_verified_at', 'email_verified_at');
            });
        }
        Schema::table('password_resets', function (Blueprint $table) {
            $table->renameColumn('phone', 'email');
        });
    }
}
