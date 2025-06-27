<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionDetails;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

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
}
