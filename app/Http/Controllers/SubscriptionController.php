<?php

namespace App\Http\Controllers;

use App\Helpers\SubscriptionHelper;
use App\Models\CardDetail;
use App\Models\SubscriptionDetails;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;

class SubscriptionController extends Controller
{
    public function loadSubscription()
    {
        $plans = SubscriptionPlan::where('enabled', 1)->get();
        return view('subscription', compact('plans'));
    }

    public function getPlanDetails(Request $request)
    {
        try {
            $planData = SubscriptionPlan::where('id', $request->id)->first();
            $haveAnyActivePlan = SubscriptionDetails::where(['user_id' => auth()->user()->id, 'status' => 'active'])->count();
            $msg = '';
            if ($haveAnyActivePlan == 0 && ($planData->trial_days !== null && $planData->trial_days !== "")) {
                $msg = 'You will get' . ' ' . $planData->trial_days . ' ' . "days free trial, and after we will charge $" . $planData->plan_amount . ' ' . "for" . ' ' . $planData->name . ' ' . "Subscription plan";
            } else {
                $msg = "We will charge $" . $planData->plan_amount . ' ' . "for" . ' ' . $planData->name . ' ' . "Subscription plan";
            }
            return response()->json(["success" => true, 'msg' => $msg, 'data' => $planData]);
        } catch (\Exception $e) {
            return response()->json(["success" => false]);
        }
    }

    public function createSubscription(Request $request)
    {
        try {
            $user_id = auth()->user()->id;
            $secretKey = env('STRIPE_SECRET_KEY');
            Stripe::setApiKey($secretKey);
            $stripeData = $request->input('data');

            $customer = $this->createCustomer($stripeData['id']);
            $customer_id = $customer['id'];

            $subscriptionPlan = SubscriptionPlan::where('id', $request->plan_id)->first();

            if ($subscriptionPlan->type == 0) { // monthly trial
                $subscriptionData =  SubscriptionHelper::start_monthly_trial_subscription($customer_id, $user_id, $subscriptionPlan);
            } else if ($subscriptionPlan->type == 1) { // yearly trial
                $subscriptionData =  SubscriptionHelper::start_yearly_trial_subscription($customer_id, $user_id, $subscriptionPlan);
            } else if ($subscriptionPlan->type == 2) { // lifetime trial
                $subscriptionData =  SubscriptionHelper::start_lifetime_trial_subscription($customer_id, $user_id, $subscriptionPlan);
            }

            $this->saveCardDetails($stripeData, $user_id, $customer_id);

            if ($subscriptionData) {
                return response()->json(['success' => true, 'msg' => 'Subscription purchased!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Subscription purchased failed!']);
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage(),
            ]);
        }
    }

    public function createCustomer($token_id)
    {
        $customer = Customer::create([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'source' => $token_id,
        ]);

        return $customer;
    }

    public function saveCardDetails($cardData, $user_id, $customer_id)
    {
        CardDetail::updateOrCreate(['user_id' => $user_id, 'card_number' => $cardData['card']['last4']], [
            'user_id' => $user_id,
            'customer_id' => $customer_id,
            'card_id' => $cardData['card']['id'],
            'name' => $cardData['card']['name'],
            'card_number' => $cardData['card']['last4'],
            'brand' => $cardData['card']['brand'],
            'month' => $cardData['card']['exp_month'],
            'year' => $cardData['card']['exp_year'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}