<?php

namespace App\Http\Controllers;

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
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $stripeData = $request->input('data');

            $customer = $this->createCustomer($stripeData['id']);

            if ($customer) {
                CardDetail::create([
                    'user_id' => auth()->user()->id,
                    'customer_id' => $customer->id,
                    'card_id' => $stripeData['card']['id'],
                    'name' => $stripeData['card']['name'],
                    'card_number' => $stripeData['card']['last4'],
                    'brand' => $stripeData['card']['brand'],
                    'month' => $stripeData['card']['exp_month'],
                    'year' => $stripeData['card']['exp_year'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                return response()->json(['success' => true, 'msg' => 'Customer Created!', 'customer' => $customer]);
            } else {
                return response()->json(['success' => false, 'msg' => 'Failed to create customer!']);
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
}
