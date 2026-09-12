<?php

namespace App\Http\Controllers\FSDKUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    // My Complaints
// My Complaints
public function index(Request $request)
{
    $userId = session('fsdk_user_id');

    if (!$userId) {
        return redirect()
            ->route('user.login')
            ->with('error', 'Please login first.');
    }

    // Search & Filter
    $search = $request->input('search');
    $status = $request->input('status', 'all');

    $query = DB::table('complaints')
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
    ->leftJoin(
        'feedback',
        function ($join) use ($userId) {
            $join->on(
                'complaints.complaint_id',
                '=',
                'feedback.complaint_id'
            )
            ->where(
                'feedback.user_id',
                '=',
                $userId
            );
        }
    )
    ->where('complaints.user_id', $userId)
    ->select(
        'complaints.*',
        'locations.location_name',
        'facility_types.facility_type_name',
        'feedback.feedback_id',
        'feedback.rating as feedback_rating',
        'feedback.submitted_at as feedback_submitted_at'
    );

    // Search
    if ($search) {
        $query->where(function ($q) use ($search) {

            $q->where(
                'complaints.complaint_code',
                'like',
                '%' . $search . '%'
            )
            ->orWhere(
                'complaints.issue_title',
                'like',
                '%' . $search . '%'
            )
            ->orWhere(
                'locations.location_name',
                'like',
                '%' . $search . '%'
            );

        });
    }

    // Status Filter
    if ($status !== 'all') {
        $query->where(
            'complaints.status',
            $status
        );
    }

    $complaints = $query
        ->orderBy('complaints.submitted_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view(
        'users.complaints',
        compact(
            'complaints',
            'search',
            'status'
        )
    );
}


// Complaint Detail
public function detail($id)
{
    $userId = session('fsdk_user_id');

    if (!$userId) {
        return redirect()
            ->route('user.login')
            ->with('error', 'Please login first.');
    }

    $complaint = DB::table('complaints')
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
        ->leftJoin(
            'assignments',
            'complaints.complaint_id',
            '=',
            'assignments.complaint_id'
        )
        ->leftJoin(
            'users as technicians',
            'assignments.technician_id',
            '=',
            'technicians.user_id'
        )
        ->leftJoin(
            'maintenance_records',
            'assignments.assignments_id',
            '=',
            'maintenance_records.assignments_id'
        )
        ->where('complaints.complaint_id', $id)
        ->where('complaints.user_id', $userId)
        ->select(
            // Complaint
            'complaints.*',

            // Location & Facility
            'locations.location_name',
            'facility_types.facility_type_name',

            // Assignment
            'assignments.assignments_id',
            'assignments.assignment_status',
            'assignments.assigned_at',

            // Technician
            'technicians.name as technician_name',

            // Maintenance
            'maintenance_records.maintenance_note',
            'maintenance_records.completion_photo',
            'maintenance_records.completed_at'
        )
        ->first();

    if (!$complaint) {
    return redirect()
        ->route('user.complaints')
        ->with('error', 'Complaint not found.');
    }

    // Get feedback submitted by this user for this complaint
    $feedback = DB::table('feedback')
        ->where('complaint_id', $id)
        ->where('user_id', $userId)
        ->first();

    return view(
        'users.complaint_detail',
        compact(
            'complaint',
            'feedback'
        )
    );
}


    // Report Issue Form
    public function create()
    {
        $locations = DB::table('locations')
            ->where('status', 'active')
            ->orderBy('location_name')
            ->get();

        $facilityTypes = DB::table('facility_types')
            ->where('status', 'active')
            ->orderBy('facility_type_name')
            ->get();

        return view('users.report-issuelogin', compact(
            'locations',
            'facilityTypes'
        ));
    }

// Store Complaint   
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'facility_type_id' => 'required|integer',
        'location_id' => 'required|integer',
        'evidence' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $location = DB::table('locations')
        ->where('location_id', $request->location_id)
        ->where('status', 'active')
        ->first();

    if (!$location) {
        return back()
            ->withInput()
            ->withErrors([
                'location_id' => 'The selected location is not available.'
            ]);
    }

    $facilityIds = $location->available_facility_types
        ? json_decode($location->available_facility_types, true)
        : [];

    if (!in_array(
        (int) $request->facility_type_id,
        array_map('intval', $facilityIds),
        true
    )) {
        return back()
            ->withInput()
            ->withErrors([
                'facility_type_id' => 'The selected facility is not available at this location.'
            ]);
    }

    $facilityType = DB::table('facility_types')
        ->where('facility_type_id', $request->facility_type_id)
        ->where('status', 'active')
        ->first();

    if (!$facilityType) {
        return back()
            ->withInput()
            ->withErrors([
                'facility_type_id' => 'The selected facility type is not available.'
            ]);
    }

    $userId = session('fsdk_user_id');

    if (!$userId) {
        return redirect()
            ->route('user.login')
            ->with('error', 'Please login first.');
    }

    // Upload defect photo (optional)
    $defectPhoto = null;

    if ($request->hasFile('evidence')) {
        $defectPhoto = $request->file('evidence')
            ->store('complaints', 'public');
    }

    // Generate temporary complaint code
    $complaintCode = 'RCM-' . now()->format('dmHis');

    // Insert complaint
    $complaintId = DB::table('complaints')->insertGetId([
        'complaint_code' => $complaintCode,
        'user_id' => $userId,
        'location_id' => $request->location_id,
        'facility_type_id' => $request->facility_type_id,
        'issue_title' => $request->title,
        'issue_description' => $request->description,
        'defect_photo' => $defectPhoto,
        'status' => 'pending',
        'priority' => 'medium',
        'submitted_at' => now(),
        'updated_at' => now(),
    ]);

    // Generate final complaint code
    $complaintCode = 'RCM-' . now()->format('dmHis') . '-' . str_pad(
        $complaintId,
        3,
        '0',
        STR_PAD_LEFT
    );

    // Update complaint code
    DB::table('complaints')
        ->where('complaint_id', $complaintId)
        ->update([
            'complaint_code' => $complaintCode,
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('user.complaints')
        ->with('success', 'Complaint submitted successfully.');
    }

    // Store Feedback
public function storeFeedback(Request $request, $id)
{
    $userId = session('fsdk_user_id');

    if (!$userId) {
        return redirect()
            ->route('user.login')
            ->with('error', 'Please login first.');
    }

    // Validate feedback
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    // Make sure the complaint belongs to this user    
    $complaint = DB::table('complaints')
        ->where('complaint_id', $id)
        ->where('user_id', $userId)
        ->where('status', 'resolved')
        ->first();

    if (!$complaint) {
        return redirect()
            ->route('user.complaints')
            ->with('error', 'Feedback can only be submitted for resolved complaints.');
    }

    // Check whether feedback already exists
    $existingFeedback = DB::table('feedback')
        ->where('complaint_id', $id)
        ->where('user_id', $userId)
        ->first();

    if ($existingFeedback) {
        return redirect()
            ->route('user.complaints.detail', $id)
            ->with('error', 'You have already submitted feedback for this complaint.');
    }

    // Insert feedback
    DB::table('feedback')->insert([
        'complaint_id' => $id,
        'user_id' => $userId,
        'rating' => $request->rating,
        'comment' => $request->comment,
        'submitted_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('user.complaints.detail', $id)
        ->with('success', 'Feedback submitted successfully.');
}
}