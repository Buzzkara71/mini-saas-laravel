<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Main dashboard view
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $stats = [
            'projects_count' => $user->projects()->count(),
            'active_plan'    => optional($user->currentPlan())->name,
            'next_renewal'   => optional(optional($user->currentSubscription())->renews_at)?->format('d M Y'),
        ];

        return view('dashboard.index-modern', compact('user', 'stats'));
    }
}
