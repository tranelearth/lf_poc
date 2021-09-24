<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLfDataToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // when updating user table, you also need to update App/Actions/Fortify/CreateNewUser.php, 
        // App/Models/User.php, AppLayout.vue, Register.vue, UpdateProfileInformationForm.vue and all instances of page.props.user.name
        Schema::table('users', function (Blueprint $table) {
            $table->after('name', function ($table) {
                $table->string('username')->nullable();
                /*$table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('company')->nullable();
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->string('city')->nullable();
                $table->string('state', 2)->nullable();
                $table->string('zip', 10)->nullable();
                $table->string('phone', 12)->nullable();*/
                $table->bigInteger('saas_user_id')->nullable();
                $table->bigInteger('carrier_id')->nullable();
            });
            $table->after('password', function ($table) {
                $table->ipAddress('ip_address')->nullable();
                $table->boolean('accepted_terms')->nullable();
                /*$table->boolean('is_banned')->nullable();
                $table->date('banned_date')->nullable();
                $table->string('timezone')->nullable();*/
            });
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
            $table->foreign('saas_user_id')->references('id')->on('liq_saas_user');
            $table->foreign('carrier_id')->references('id')->on('liq_master_file_carrierprofile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
        });
    }
}
