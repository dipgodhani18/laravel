<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }

    public function dashboard()
    {
        $users = User::all(); // Fetch all users
        $blockedUsers = User::where('status', 1)->count() ?? 0;
        $verifiedUsers = User::whereNull('email_verified_at')->count() ?? 0;
        $activeUsers = User::where('status', 0)
            ->whereNotNull('email_verified_at')
            ->count() ?? 0;
        $totalUsers = User::count() ?? 0;

        // Get user registrations for the last 7 days
        $last7Days = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Initialize date wise array with 0 count
        $userChartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $userChartData[$date] = 0;
        }

        foreach ($last7Days as $entry) {
            $userChartData[$entry->date] = $entry->count;
        }

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'verifiedUsers' => $verifiedUsers,
            'blockedUsers' => $blockedUsers,
            'activeUsers' => $activeUsers,
            'users' => $users,
            'userChartLabels' => json_encode(array_keys($userChartData)),
            'userChartCounts' => json_encode(array_values($userChartData)),
        ]);
    }

    public function blockedUsers()
    {
        $blockedUsers = User::where('status', 1)->get();
        return view('admin.pages.blocked_users', compact('blockedUsers'));
    }
    public function unverifiedUsers()
    {
        $unverifiedUsers = User::whereNull('email_verified_at')->get();
        return view('admin.pages.unverified_users', compact('unverifiedUsers'));
    }
    public function activeUsers()
    {
        $activeUsers = User::where('status', 0)->whereNotNull('email_verified_at')->get();
        return view('admin.pages.active_users', compact('activeUsers'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You are now logged out.');
    }

    public function showUsers()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.users', compact('users'));
    }

    public function viewUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.users_details', compact('user'));
    }

    public function blockUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->status = $user->status == 0 ? 1 : 0; // Toggle between 0 and 1
        $user->save();

        $msg = $user->status == 1 ? 'User blocked successfully.' : 'User unblocked successfully.';
        return redirect()->back()->with('success', $msg);
    }


    public function getDashboardData()
    {
        $last7Days = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $userChartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $userChartData[$date] = 0;
        }

        foreach ($last7Days as $entry) {
            $userChartData[$entry->date] = $entry->count;
        }

        return response()->json([
            'chartLabels' => array_keys($userChartData),
            'chartData' => array_values($userChartData),
        ]);
    }

    public  function getDashboardData2()
    {
        $today = Carbon::now();

        $last7Months = User::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw("COUNT(*) as count")
        )
            ->where('created_at', '>=', $today->copy()->subMonths(6)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $userChartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $monthKey = $today->copy()->subMonths($i)->format('Y-m');
            $userChartData[$monthKey] = 0;
        }

        foreach ($last7Months as $entry) {
            $userChartData[$entry->month] = $entry->count;
        }

        $chartLabels = [];
        foreach (array_keys($userChartData) as $monthKey) {
            $chartLabels[] = Carbon::createFromFormat('Y-m', $monthKey)->format('M Y');
        }

        return response()->json([
            'chartLabels' => $chartLabels,
            'chartData' => array_values($userChartData),
        ]);
    }
}
