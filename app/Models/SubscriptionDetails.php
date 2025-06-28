<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_subscription_id',
        'stripe_subscription_shedule_id',
        'stripe_customer_id',
        'subscription_plan_price_id',
        'plan_amount',
        'plan_amount_currency',
        'plan_interval',
        'plan_interval_count',
        'plan_created_at',
        'plan_started_at',
        'plan_ended_at',
        'trial_ended_at',
        'status',
        'cancle',
        'cancelled_at',
        'created_at',
        'updated_at',
    ];
}