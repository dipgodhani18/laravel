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
        Schema::create('subscription_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_subscription_shedule_id')->nullable();
            $table->string('stripe_customer_id');
            $table->string('subscription_plan_price_id');
            $table->float('plan_amount', 10, 2);
            $table->string('plan_amount_currency');
            $table->string('plan_interval');
            $table->string('plan_interval_count');
            $table->timestamp('plan_created_at');
            $table->timestamp('plan_started_at')->nullable();
            $table->timestamp('plan_ended_at')->nullable();
            $table->timestamp('trial_ended_at')->nullable();
            $table->enum('status', ['active', 'cancelled']);
            $table->integer('cancle')->default(0)->comment('0 -> active, 1 -> cancelled');
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_details');
    }
};