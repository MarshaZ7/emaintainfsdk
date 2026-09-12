<?php

namespace App\Http\Controllers\FSDKUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = session('fsdk_user_id');

        // Total complaints user
        $totalComplaints = DB::table('complaints')
            ->where('user_id', $userId)
            ->count();

        // Pending complaints
        $pendingComplaints = DB::table('complaints')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        // In Progress complaints
        $inProgressComplaints = DB::table('complaints')
            ->where('user_id', $userId)
            ->where('status', 'in_progress')
            ->count();

        // Resolved complaints
        $resolvedComplaints = DB::table('complaints')
            ->where('user_id', $userId)
            ->where('status', 'resolved')
            ->count();

        // Recent complaints
        $recentComplaints = DB::table('complaints')
            ->leftJoin(
                'locations',
                'complaints.location_id',
                '=',
                'locations.location_id'
            )
            ->leftJoin(
                'facility_types',
                'complaints.facility_type_id',
                '=',
                'facility_types.facility_type_id'
            )
            ->where('complaints.user_id', $userId)
            ->select(
                'complaints.complaint_code',
                'complaints.complaint_id',
                'complaints.issue_title',
                'complaints.status',
                'complaints.submitted_at',
                'locations.location_name',
                'facility_types.facility_type_name'
            )
            ->orderBy('complaints.submitted_at', 'desc')
            ->limit(5)
            ->get();

        return view('users.dashboard', compact(
            'totalComplaints',
            'pendingComplaints',
            'inProgressComplaints',
            'resolvedComplaints',
            'recentComplaints'
        ));
    }
      
    public function faq(){
        return view('users.faqlogin');
    }
    public function report(){
        return view('users.report-issuelogin');
    }

    public function profile(){
        return view('users.profile');
    }
}