<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Plan;
use App\Models\StripeUser;
use App\Utils\StripeHelper;
use Exception;
use Illuminate\Support\Facades\DB;

class StripePaymentController extends Controller
{
    public function showPlan()
    {
        try {
            $planDetails = Plan::select('id', 'plan_name', 'uuid', 'plan_amount')->get();
            return view('plans', compact('planDetails'));
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function checkoutPage($planId)
    {
        try {
            $planDetails = Plan::where('uuid', $planId)
                ->where('status', 1) // Assuming 'status' means active
                ->first();

            if ($planDetails) {
                return view('checkout', ['plan' => $planDetails]);
            } else {
                return redirect()->route('payment.plans')->with('error', 'Invalid plan selected.');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function processPayment(PaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $planId = $request->plan_id;
            $stripeToken = $request->stripe_token;
            $user = auth()->user();

            $plan = Plan::where('uuid', $planId)->first();
            if (!$plan) {
                throw new Exception('Invalid plan.');
            }


            $stripePlanId = $plan->stripe_plan_id;

            // Create Stripe customer if not exists
            if ($user->stripeUser) {
                $customerId = $user->stripeUser->stripe_customer_id;
            } else {
                $userCustomer = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'source' => $stripeToken
                ];

                $customer = StripeHelper::createCustomer($userCustomer, $stripeToken);

                if (!$customer['status']) {
                    throw new Exception($customer['error']);
                }
                $customerId = $customer['data']->id;

                StripeUser::create([
                    'user_id' => $user->id,
                    'stripe_customer_id' => $customerId,
                ]);
            }

            // Create Subscription
            $subscription = StripeHelper::createSubscription($customerId, $stripePlanId);

            if (!$subscription['status']) {
                throw new Exception($subscription['error']);
            }

            // Save subscription (Implement your own method)
            $this->userSubscription($subscription, $plan, $user);

            DB::commit();
            return redirect()->route('payment.plans')->with('success', 'Subscription created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
