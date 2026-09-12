<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{ 
    public function index()
    {
    $totalComplaints = DB::table('complaints')->count();

    $pendingComplaints = DB::table('complaints')
        ->where('status', 'pending')
        ->count();

    $inProgressComplaints = DB::table('complaints')
        ->where('status', 'in_progress')
        ->count();

    $resolvedComplaints = DB::table('complaints')
        ->where('status', 'resolved')
        ->count();

    $recentComplaints = DB::table('complaints')
        ->join('users', 'complaints.user_id', '=', 'users.user_id')
        ->leftJoin('facility_types', 'complaints.facility_type_id', '=', 'facility_types.facility_type_id')
        ->select(
            'complaints.complaint_id',
            'complaints.complaint_code',
            'complaints.status',
            'complaints.submitted_at',
            'users.name as reporter_name',
            'facility_types.facility_type_name'
        )
        ->orderBy('complaints.submitted_at', 'desc')
        ->limit(5)
        ->get();

    return view('admin.dashboard', compact(
        'totalComplaints',
        'pendingComplaints',
        'inProgressComplaints',
        'resolvedComplaints',
        'recentComplaints'
    ));
    }
    
   public function complaints(Request $request)
{
    // Search & Filter
    $search = $request->input('search');
    $status = $request->input('status', 'all');

    $query = DB::table('complaints')
        ->join(
            'users',
            'complaints.user_id',
            '=',
            'users.user_id'
        )
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
        ->select(
            'complaints.*',
            'users.name as reporter_name',
            'users.university_id',
            'users.email as reporter_email',
            'locations.location_name',
            'facility_types.facility_type_name',
            'assignments.assignments_id'
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
                'users.name',
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

    // Pagination
    $complaints = $query
        ->orderBy('complaints.submitted_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    // Statistics
    $totalComplaints = DB::table('complaints')->count();

    $pendingComplaints = DB::table('complaints')
        ->where('status', 'pending')
        ->count();

    $inProgressComplaints = DB::table('complaints')
        ->where('status', 'in_progress')
        ->count();

    $resolvedComplaints = DB::table('complaints')
        ->where('status', 'resolved')
        ->count();

    return view('admin.complaints', compact(
        'complaints',
        'totalComplaints',
        'pendingComplaints',
        'inProgressComplaints',
        'resolvedComplaints',
        'search',
        'status'
    ));
}

    public function userManagement(Request $request)
    {
    $query = DB::table('users')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.role_id')
        ->select(
            'users.user_id',
            'users.name',
            'users.university_id',
            'users.email',
            'users.role_id',
            'roles.role_name'
        );

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('users.name', 'like', "%{$search}%")
              ->orWhere('users.university_id', 'like', "%{$search}%");
        });
    }

    if ($request->filled('role')) {
        $query->where('roles.role_name', $request->role);
    }

    $users = $query->orderBy('users.created_at', 'desc')->get();

    $totalUsers = DB::table('users')->count();

    $totalRegularUsers = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.role_id')
        ->where('roles.role_name', 'user')
        ->count();

    $admins = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.role_id')
        ->where('roles.role_name', 'admin')
        ->count();

    $technicians = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.role_id')
        ->where('roles.role_name', 'technician')
        ->count();

    return view('admin.users', compact(
        'users',
        'totalUsers',
        'totalRegularUsers',
        'admins',
        'technicians'
    ));
    }

    public function createUser()
    {
    $roles = DB::table('roles')
        ->orderBy('role_name')
        ->get();

    return view('admin.users.create', compact('roles'));
    }

    public function storeUser(Request $request)
{
    $request->validate([
        'role_id' => 'required|integer|exists:roles,role_id',
        'university_id' => 'required|string|max:50|unique:users,university_id',
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100|unique:users,email',
        'phone' => 'nullable|string|max:20',
        'password' => 'required|string|min:8|confirmed',
        'status' => 'required|string|max:20',
    ]);

    DB::table('users')->insert([
        'role_id' => $request->role_id,
        'university_id' => $request->university_id,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'status' => $request->status,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('admin.users')
        ->with('success', 'User account has been created successfully.');
    }

    public function editUser($id)
    {
    $user = DB::table('users')
        ->where('users.user_id', $id)
        ->first();

    if (!$user) {
        return redirect()->route('admin.users')
            ->with('error', 'User not found.');
    }

    $roles = DB::table('roles')
        ->orderBy('role_name')
        ->get();

    return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
    $request->validate([
        'role_id' => 'required|exists:roles,id',
        'university_id' => 'required|string|max:50|unique:users,university_id,' . $id,
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|min:8|confirmed',
        'status' => 'required|in:active,inactive',
    ]);

    $data = [
        'role_id' => $request->role_id,
        'university_id' => $request->university_id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'status' => $request->status,
        'updated_at' => now(),
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    DB::table('users')
        ->where('id', $id)
        ->update($data);

    return redirect()->route('admin.users')
        ->with('success', 'User updated successfully.');
    }

    public function updateComplaintPriority(Request $request, $id)
{
    $request->validate([
        'priority' => 'required|in:low,medium,high',
    ]);

    $complaint = DB::table('complaints')
        ->where('complaint_id', $id)
        ->where('status', 'pending')
        ->first();

    if (!$complaint) {
        return redirect()
            ->route('admin.complaints')
            ->with('error', 'Priority can only be set for pending complaints.');
    }

    DB::table('complaints')
        ->where('complaint_id', $id)
        ->update([
            'priority' => $request->priority,
        ]);

    return redirect()
        ->route('admin.complaints')
        ->with('success', 'Complaint priority updated successfully.');
}

public function rejectComplaint(Request $request, $id)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:500',
    ]);

    $complaint = DB::table('complaints')
        ->where('complaint_id', $id)
        ->first();

    if (!$complaint) {
        return redirect()
            ->route('admin.complaints')
            ->with('error', 'Complaint not found.');
    }

    // Hanya complaint dengan status pending yang dapat ditolak
    if ($complaint->status !== 'pending') {
        return redirect()
            ->route('admin.complaints')
            ->with('error', 'Only pending complaints can be rejected.');
    }

    DB::table('complaints')
        ->where('complaint_id', $id)
        ->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('admin.complaints')
        ->with('success', 'Complaint has been rejected successfully.');
}


    public function assignments()
    {
    $assignments = DB::table('assignments')
        ->join(
            'complaints',
            'assignments.complaint_id',
            '=',
            'complaints.complaint_id'
        )
        ->join(
            'users as technicians',
            'assignments.technician_id',
            '=',
            'technicians.user_id'
        )
        ->join(
            'users as admins',
            'assignments.admin_id',
            '=',
            'admins.user_id'
        )
        ->join(
            'locations',
            'complaints.location_id',
            '=',
            'locations.location_id'
        )
        ->join(
            'facility_types',
            'complaints.facility_type_id',
            '=',
            'facility_types.facility_type_id'
        )
        ->select(
            'assignments.assignments_id',
            'assignments.assigned_at',
            'assignments.assignment_status',
            'assignments.assignment_note',

            'complaints.complaint_id',
            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.priority',

            'technicians.name as technician_name',
            'admins.name as admin_name',

            'locations.location_name',
            'facility_types.facility_type_name'
        )
        ->orderBy('assignments.assigned_at', 'desc')
        ->get();

    return view('admin.assignments', compact('assignments'));
}


public function assignmentDetail($id)
{
    if (!session('admin_id')) {
        return redirect()
            ->route('admin.login')
            ->with('error', 'Please login first.');
    }

    $assignment = DB::table('assignments')
        ->join(
            'complaints',
            'assignments.complaint_id',
            '=',
            'complaints.complaint_id'
        )
        ->join(
            'users as technicians',
            'assignments.technician_id',
            '=',
            'technicians.user_id'
        )
        ->join(
            'users as complainants',
            'complaints.user_id',
            '=',
            'complainants.user_id'
        )
        ->join(
            'users as admins',
            'assignments.admin_id',
            '=',
            'admins.user_id'
        )
        ->join(
            'locations',
            'complaints.location_id',
            '=',
            'locations.location_id'
        )
        ->join(
            'facility_types',
            'complaints.facility_type_id',
            '=',
            'facility_types.facility_type_id'
        )
        ->leftJoin(
            'maintenance_records',
            'assignments.assignments_id',
            '=',
            'maintenance_records.assignments_id'
        )

        ->leftJoin(
        'feedback',
        function ($join) {
            $join->on(
                'complaints.complaint_id',
                '=',
                'feedback.complaint_id'
            )
            ->on(
                'complaints.user_id',
                '=',
                'feedback.user_id'
            );
        }
    )
        ->select(
            // Assignment
            'assignments.assignments_id',
            'assignments.assigned_at',
            'assignments.assignment_status',
            'assignments.assignment_note',

            // Complaint
            'complaints.complaint_id',
            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.issue_description',
            'complaints.priority',
            'complaints.status as complaint_status',
            'complaints.submitted_at',
            'complaints.defect_photo',

            // Technician
            'technicians.name as technician_name',
            'technicians.email as technician_email',
            'technicians.university_id as technician_university_id',

            // Complainant
            'complainants.name as complainant_name',
            'complainants.email as complainant_email',
            'complainants.university_id as complainant_university_id',

            // Admin
            'admins.name as admin_name',

            // Location & Facility
            'locations.location_name',
            'locations.description as location_description',
            'facility_types.facility_type_name',

            // Maintenance Record
            'maintenance_records.maintenance_id',
            'maintenance_records.maintenance_note',
            'maintenance_records.completion_photo',
            'maintenance_records.completed_at',

            // Feedback
            'feedback.feedback_id',
            'feedback.rating as feedback_rating',
            'feedback.comment as feedback_comment',
            'feedback.submitted_at as feedback_submitted_at'
        )
        ->where('assignments.assignments_id', $id)
        ->first();

    if (!$assignment) {
        return redirect()
            ->route('admin.assignments')
            ->with('error', 'Assignment not found.');
    }

    return view(
        'admin.assignment-detail',
        compact('assignment')
    );
}


    public function createAssignment()
{
    // Ambil complaint yang masih pending dan belum memiliki assignment
    $complaints = DB::table('complaints')
        ->leftJoin(
            'assignments',
            'complaints.complaint_id',
            '=',
            'assignments.complaint_id'
        )
        ->join(
            'locations',
            'complaints.location_id',
            '=',
            'locations.location_id'
        )
        ->join(
            'facility_types',
            'complaints.facility_type_id',
            '=',
            'facility_types.facility_type_id'
        )
        ->whereNull('assignments.complaint_id')
        ->where('complaints.status', 'pending')
        ->select(
            'complaints.complaint_id',
            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.priority',
            'complaints.status',
            'locations.location_name',
            'facility_types.facility_type_name'
        )
        ->orderBy('complaints.submitted_at', 'desc')
        ->get();

    // Ambil user yang memiliki role Technician dan berstatus aktif
    $technicians = DB::table('users')
        ->join(
            'roles',
            'users.role_id',
            '=',
            'roles.role_id'
        )
        ->where('roles.role_name', 'technician')
        ->where('users.status', 'active')
        ->select(
            'users.user_id',
            'users.name',
            'users.university_id'
        )
        ->orderBy('users.name')
        ->get();

    return view('admin.assignments.create', compact(
        'complaints',
        'technicians'
    ));
}

public function storeAssignment(Request $request)
{
    $request->validate([
        'complaint_id' => 'required|integer',
        'technician_id' => 'required|integer',
        'assignment_note' => 'nullable|string',
    ]);

    $adminId = session('admin_id');

    // Pastikan admin sudah login
    if (!$adminId) {
        return redirect()
            ->route('admin.login')
            ->with('error', 'Admin session not found. Please login again.');
    }

    $complaint = DB::table('complaints')
        ->where('complaint_id', $request->complaint_id)
        ->where('status', 'pending')
        ->first();

    if (!$complaint) {
        return redirect()
            ->route('admin.assignments.create')
            ->with('error', 'The selected complaint is no longer available for assignment.');
    }

    
    $existingAssignment = DB::table('assignments')
        ->where('complaint_id', $request->complaint_id)
        ->exists();

    if ($existingAssignment) {
        return redirect()
            ->route('admin.assignments.create')
            ->with('error', 'This complaint has already been assigned.');
    }

    $technician = DB::table('users')
        ->join(
            'roles',
            'users.role_id',
            '=',
            'roles.role_id'
        )
        ->where('users.user_id', $request->technician_id)
        ->where('roles.role_name', 'technician')
        ->where('users.status', 'active')
        ->first();

    if (!$technician) {
        return redirect()
            ->route('admin.assignments.create')
            ->with('error', 'The selected technician is not available.');
    }
    
    DB::table('assignments')->insert([
        'complaint_id' => $request->complaint_id,
        'technician_id' => $request->technician_id,
        'admin_id' => $adminId,
        'assigned_at' => now(),
        'assignment_status' => 'pending',
        'assignment_note' => $request->assignment_note ?? '-',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('complaints')
        ->where('complaint_id', $request->complaint_id)
        ->update([
            'status' => 'assigned',
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('admin.assignments')
        ->with('success', 'Assignment has been created successfully.');
}
    

    public function accountSettings()
    {
    $user = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.role_id')
        ->where('users.user_id', session('admin_id'))
        ->select('users.*', 'roles.role_name')
        ->first();

    if (!$user) {
        return redirect()->route('admin.dashboard')
            ->with('error', 'User account not found.');
    }

    return view('admin.settings', compact('user'));
    }

    public function updateAccount(Request $request)
    {
    $userId = session('admin_id');

    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100|unique:users,email,' . $userId . ',user_id',
        'phone' => 'nullable|string|max:20',
    ]);

    DB::table('users')
        ->where('user_id', $userId)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => now(),
        ]);

    session([
        'admin_name' => $request->name,
        'admin_email' => $request->email,
    ]);

    return redirect()->route('admin.settings')
        ->with('success', 'Profile information updated successfully.');
    }

    public function updatePassword(Request $request)
    {
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = DB::table('users')
        ->where('user_id', session('admin_id'))
        ->first();

    if (!$user || !Hash::check($request->current_password, $user->password)) {
        return back()
            ->withErrors(['current_password' => 'Current password is incorrect.'])
            ->withInput();
    }

    DB::table('users')
        ->where('user_id', session('admin_id'))
        ->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);

    return redirect()->route('admin.settings')
        ->with('success', 'Password updated successfully.');
    }


    // Locations
    public function locations()
{
    $locations = DB::table('locations')
        ->orderBy('location_id', 'desc')
        ->get();

    $facilityTypes = DB::table('facility_types')
        ->get()
        ->keyBy('facility_type_id');

    foreach ($locations as $location) {
        $facilityIds = $location->available_facility_types
            ? json_decode($location->available_facility_types, true)
            : [];

        $location->available_facilities = collect($facilityIds)
            ->map(function ($id) use ($facilityTypes) {
                return $facilityTypes->get($id);
            })
            ->filter()
            ->values();
    }

    return view('admin.locations', compact('locations'));
}

    public function createLocation()
{
    $facilityTypes = DB::table('facility_types')
        ->orderBy('facility_type_name', 'asc')
        ->get();

    return view('admin.locations.create', compact('facilityTypes'));
}

    public function storeLocation(Request $request)
{
    $request->validate([
        'location_name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'available_facility_types' => 'nullable|array',
        'available_facility_types.*' => 'integer',
    ]);

    DB::table('locations')->insert([
        'location_name' => $request->location_name,
        'description' => $request->description,

        // Simpan array facility type sebagai JSON
        'available_facility_types' => $request->available_facility_types
            ? json_encode($request->available_facility_types)
            : null,

        'status' => 'active',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('admin.locations')
        ->with('success', 'Location added successfully.');
}

    public function editLocation($id)
{
    $location = DB::table('locations')
        ->where('location_id', $id)
        ->first();

    if (!$location) {
        return redirect()
            ->route('admin.locations')
            ->with('error', 'Location not found.');
    }

    $facilityTypes = DB::table('facility_types')
        ->orderBy('facility_type_name', 'asc')
        ->get();

    return view('admin.locations.edit', compact('location', 'facilityTypes'));
}

    public function updateLocation(Request $request, $id)
{
    $request->validate([
        'location_name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'available_facility_types' => 'nullable|array',
        'available_facility_types.*' => 'integer',
        'status' => 'required|in:active,inactive',
    ]);

    $location = DB::table('locations')
        ->where('location_id', $id)
        ->first();

    if (!$location) {
        return redirect()
            ->route('admin.locations')
            ->with('error', 'Location not found.');
    }

    DB::table('locations')
        ->where('location_id', $id)
        ->update([
            'location_name' => $request->location_name,
            'description' => $request->description,

            // Simpan facility type sebagai JSON
            'available_facility_types' => $request->available_facility_types
                ? json_encode($request->available_facility_types)
                : null,

            'status' => $request->status,
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('admin.locations')
        ->with('success', 'Location updated successfully.');
}

   public function facilityTypes()
    {
    $facilityTypes = DB::table('facility_types')
        ->orderBy('facility_type_id', 'desc')
        ->get();

    return view('admin.facility-types', compact('facilityTypes'));
    }

    public function createFacilityType()
    {
    return view('admin.facility-types.create');
    }
    public function storeFacilityType(Request $request)
    {
    $request->validate([
        'facility_type_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    DB::table('facility_types')->insert([
        'facility_type_name' => $request->facility_type_name,
        'description' => $request->description,
        'status' => $request->status,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('admin.facility.types')
        ->with('success', 'Facility type added successfully.');
    }
    public function editFacilityType($id)
    {
    $facilityType = DB::table('facility_types')
        ->where('facility_type_id', $id)
        ->first();

    if (!$facilityType) {
        return redirect()
            ->route('admin.facility.types')
            ->with('error', 'Facility type not found.');
    }

    return view('admin.facility-types.edit', compact('facilityType'));
    }

    public function updateFacilityType(Request $request, $id)
    {
    $request->validate([
        'facility_type_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    $facilityType = DB::table('facility_types')
        ->where('facility_type_id', $id)
        ->first();

    if (!$facilityType) {
        return redirect()
            ->route('admin.facility.types')
            ->with('error', 'Facility type not found.');
    }

    DB::table('facility_types')
        ->where('facility_type_id', $id)
        ->update([
            'facility_type_name' => $request->facility_type_name,
            'description' => $request->description,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('admin.facility.types')
        ->with('success', 'Facility type updated successfully.');
    }

public function reports(Request $request)
{
    if (!session('admin_id')) {
        return redirect()
            ->route('admin.login')
            ->with('error', 'Please login first.');
    }

    // Report Filter
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $filterStatus = $request->input('status');
    $filterCategory = $request->input('category');


    // Facility Types
    $facilityTypes = DB::table('facility_types')
        ->where('status', 'active')
        ->orderBy('facility_type_name')
        ->get();


    // Base Complaint Query
    $complaintQuery = DB::table('complaints');


    // Start Date
    if ($startDate) {
        $complaintQuery->whereDate(
            'submitted_at',
            '>=',
            $startDate
        );
    }

    // End Date
    if ($endDate) {
        $complaintQuery->whereDate(
            'submitted_at',
            '<=',
            $endDate
        );
    }

    // Status
    if ($filterStatus) {
        $complaintQuery->where(
            'status',
            $filterStatus
        );
    }

    // Category / Facility Type
    if ($filterCategory) {
        $complaintQuery->where(
            'facility_type_id',
            $filterCategory
        );
    }

    // Report Summary
    $totalComplaints = (clone $complaintQuery)
        ->count();


    $resolvedComplaints = (clone $complaintQuery)
        ->where('status', 'resolved')
        ->count();

    
    // Average Resolution Time
    $averageResolutionTime = DB::table('complaints')
        ->join(
            'maintenance_records',
            'complaints.complaint_id',
            '=',
            'maintenance_records.complaint_id'
        )
        ->when(
            $startDate,
            function ($query) use ($startDate) {
                $query->whereDate(
                    'complaints.submitted_at',
                    '>=',
                    $startDate
                );
            }
        )
        ->when(
            $endDate,
            function ($query) use ($endDate) {
                $query->whereDate(
                    'complaints.submitted_at',
                    '<=',
                    $endDate
                );
            }
        )
        ->when(
            $filterStatus,
            function ($query) use ($filterStatus) {
                $query->where(
                    'complaints.status',
                    $filterStatus
                );
            }
        )
        ->when(
            $filterCategory,
            function ($query) use ($filterCategory) {
                $query->where(
                    'complaints.facility_type_id',
                    $filterCategory
                );
            }
        )
        ->selectRaw(
            'AVG(
                TIMESTAMPDIFF(
                    SECOND,
                    complaints.submitted_at,
                    maintenance_records.completed_at
                )
            ) as avg_seconds'
        )
        ->value('avg_seconds');


    if ($averageResolutionTime !== null) {
        $averageResolutionTime = round(
            $averageResolutionTime / 86400,
            1
        );

    } else {

        $averageResolutionTime = 0;

    }

    $completionRate = $totalComplaints > 0
        ? round(
            ($resolvedComplaints / $totalComplaints) * 100,
            1
        )
        : 0;

    // Complaints by Category
$complaintsByCategory = DB::table('complaints')
    ->join(
        'facility_types',
        'complaints.facility_type_id',
        '=',
        'facility_types.facility_type_id'
    )
    ->when($startDate, function ($query) use ($startDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '>=',
            $startDate
        );
    })
    ->when($endDate, function ($query) use ($endDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '<=',
            $endDate
        );
    })
    ->when($filterStatus, function ($query) use ($filterStatus) {
        $query->where(
            'complaints.status',
            $filterStatus
        );
    })
    ->when($filterCategory, function ($query) use ($filterCategory) {
        $query->where(
            'complaints.facility_type_id',
            $filterCategory
        );
    })
    ->select(
        'facility_types.facility_type_name',
        DB::raw('COUNT(complaints.complaint_id) as total')
    )
    ->groupBy(
        'facility_types.facility_type_id',
        'facility_types.facility_type_name'
    )
    ->orderByDesc('total')
    ->get();


// Complaints by Status
$complaintsByStatus = DB::table('complaints')
    ->when($startDate, function ($query) use ($startDate) {
        $query->whereDate(
            'submitted_at',
            '>=',
            $startDate
        );
    })
    ->when($endDate, function ($query) use ($endDate) {
        $query->whereDate(
            'submitted_at',
            '<=',
            $endDate
        );
    })
    ->when($filterStatus, function ($query) use ($filterStatus) {
        $query->where(
            'status',
            $filterStatus
        );
    })
    ->when($filterCategory, function ($query) use ($filterCategory) {
        $query->where(
            'facility_type_id',
            $filterCategory
        );
    })
    ->select(
        'status',
        DB::raw('COUNT(complaint_id) as total')
    )
    ->groupBy('status')
    ->orderByDesc('total')
    ->get();

    // Technician Performance
    $technicianPerformance = DB::table('assignments')
    ->join(
        'users',
        'assignments.technician_id',
        '=',
        'users.user_id'
    )
    ->join(
        'complaints',
        'assignments.complaint_id',
        '=',
        'complaints.complaint_id'
    )
    ->when($startDate, function ($query) use ($startDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '>=',
            $startDate
        );
    })
    ->when($endDate, function ($query) use ($endDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '<=',
            $endDate
        );
    })
    ->when($filterStatus, function ($query) use ($filterStatus) {
        $query->where(
            'complaints.status',
            $filterStatus
        );
    })
    ->when($filterCategory, function ($query) use ($filterCategory) {
        $query->where(
            'complaints.facility_type_id',
            $filterCategory
        );
    })
    ->select(
        'users.name as technician_name',
        DB::raw('COUNT(assignments.assignments_id) as total_assignments'),
        DB::raw("
            SUM(
                CASE
                    WHEN assignments.assignment_status = 'completed'
                    THEN 1
                    ELSE 0
                END
            ) as completed
        "),
        DB::raw("
            SUM(
                CASE
                    WHEN assignments.assignment_status = 'in_progress'
                    THEN 1
                    ELSE 0
                END
            ) as in_progress
        "),
        DB::raw("
            SUM(
                CASE
                    WHEN assignments.assignment_status = 'pending'
                    THEN 1
                    ELSE 0
                END
            ) as pending
        ")
    )
    ->groupBy(
        'users.user_id',
        'users.name'
    )
    ->orderBy('users.name')
    ->get();

    foreach ($technicianPerformance as $technician) {

    $technician->completion_rate =
        $technician->total_assignments > 0
            ? round(
                ($technician->completed / $technician->total_assignments) * 100,
                1
            )
            : 0;
    }

    // Maintenance Report
    $maintenanceReport = DB::table('maintenance_records')
    ->join(
        'assignments',
        'maintenance_records.assignments_id',
        '=',
        'assignments.assignments_id'
    )
    ->join(
        'complaints',
        'maintenance_records.complaint_id',
        '=',
        'complaints.complaint_id'
    )
    ->join(
        'users',
        'assignments.technician_id',
        '=',
        'users.user_id'
    )
    ->join(
        'facility_types',
        'complaints.facility_type_id',
        '=',
        'facility_types.facility_type_id'
    )
    ->when($startDate, function ($query) use ($startDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '>=',
            $startDate
        );
    })
    ->when($endDate, function ($query) use ($endDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '<=',
            $endDate
        );
    })
    ->when($filterStatus, function ($query) use ($filterStatus) {
        $query->where(
            'complaints.status',
            $filterStatus
        );
    })
    ->when($filterCategory, function ($query) use ($filterCategory) {
        $query->where(
            'complaints.facility_type_id',
            $filterCategory
        );
    })
    ->select(
        'complaints.complaint_code',
        'facility_types.facility_type_name',
        'users.name as technician_name',
        'complaints.priority',
        'assignments.assigned_at',
        'maintenance_records.completed_at',
        'complaints.status'
    )
    ->orderByDesc('maintenance_records.completed_at')
    ->get();

    // Rejected Complaints
$rejectedComplaints = DB::table('complaints')
    ->join(
        'facility_types',
        'complaints.facility_type_id',
        '=',
        'facility_types.facility_type_id'
    )
    ->when($startDate, function ($query) use ($startDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '>=',
            $startDate
        );
    })
    ->when($endDate, function ($query) use ($endDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '<=',
            $endDate
        );
    })
    ->when($filterStatus, function ($query) use ($filterStatus) {
        $query->where(
            'complaints.status',
            $filterStatus
        );
    })
    ->when($filterCategory, function ($query) use ($filterCategory) {
        $query->where(
            'complaints.facility_type_id',
            $filterCategory
        );
    })
    ->where('complaints.status', 'rejected')
    ->select(
        'complaints.complaint_code',
        'complaints.issue_title',
        'facility_types.facility_type_name',
        'complaints.rejection_reason'
    )
    ->orderByDesc('complaints.submitted_at')
    ->get();


    // User Feedback
$userFeedback = DB::table('feedback')
    ->join(
        'complaints',
        'feedback.complaint_id',
        '=',
        'complaints.complaint_id'
    )
    ->join(
        'facility_types',
        'complaints.facility_type_id',
        '=',
        'facility_types.facility_type_id'
    )
    ->when($startDate, function ($query) use ($startDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '>=',
            $startDate
        );
    })
    ->when($endDate, function ($query) use ($endDate) {
        $query->whereDate(
            'complaints.submitted_at',
            '<=',
            $endDate
        );
    })
    ->when($filterStatus, function ($query) use ($filterStatus) {
        $query->where(
            'complaints.status',
            $filterStatus
        );
    })
    ->when($filterCategory, function ($query) use ($filterCategory) {
        $query->where(
            'complaints.facility_type_id',
            $filterCategory
        );
    })
    ->select(
        'complaints.complaint_code',
        'facility_types.facility_type_name',
        'feedback.rating',
        'feedback.comment',
        'feedback.submitted_at'
    )
    ->orderByDesc('feedback.submitted_at')
    ->get();


    return view('admin.reports',
        compact(
            'totalComplaints',
            'resolvedComplaints',
            'averageResolutionTime',
            'completionRate',
            'facilityTypes',
            'startDate',
            'endDate',
            'filterStatus',
            'filterCategory',
            'complaintsByCategory',
            'complaintsByStatus',
            'technicianPerformance',
            'maintenanceReport',
            'rejectedComplaints',
            'userFeedback'
        )
    );
    }

    public function exportTechnicianPerformance(Request $request)
    {
    if (!session('admin_id')) {
        return redirect()
            ->route('admin.login')
            ->with('error', 'Please login first.');
    }

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $filterStatus = $request->input('status');
    $filterCategory = $request->input('category');

    $technicianPerformance = DB::table('assignments')
        ->join(
            'users',
            'assignments.technician_id',
            '=',
            'users.user_id'
        )
        ->join(
            'complaints',
            'assignments.complaint_id',
            '=',
            'complaints.complaint_id'
        )
        ->when($startDate, function ($query) use ($startDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '>=',
                $startDate
            );
        })
        ->when($endDate, function ($query) use ($endDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '<=',
                $endDate
            );
        })
        ->when($filterStatus, function ($query) use ($filterStatus) {
            $query->where(
                'complaints.status',
                $filterStatus
            );
        })
        ->when($filterCategory, function ($query) use ($filterCategory) {
            $query->where(
                'complaints.facility_type_id',
                $filterCategory
            );
        })
        ->select(
            'users.name as technician_name',
            DB::raw('COUNT(assignments.assignments_id) as total_assignments'),
            DB::raw("
                SUM(
                    CASE
                        WHEN assignments.assignment_status = 'completed'
                        THEN 1
                        ELSE 0
                    END
                ) as completed
            "),
            DB::raw("
                SUM(
                    CASE
                        WHEN assignments.assignment_status = 'in_progress'
                        THEN 1
                        ELSE 0
                    END
                ) as in_progress
            "),
            DB::raw("
                SUM(
                    CASE
                        WHEN assignments.assignment_status = 'pending'
                        THEN 1
                        ELSE 0
                    END
                ) as pending
            ")
        )
        ->groupBy(
            'users.user_id',
            'users.name'
        )
        ->orderBy('users.name')
        ->get();

    foreach ($technicianPerformance as $technician) {
        $technician->completion_rate =
            $technician->total_assignments > 0
                ? round(
                    ($technician->completed / $technician->total_assignments) * 100,
                    1
                )
                : 0;
    }

    $pdf = Pdf::loadView(
        'admin.reports-pdf.technician-performance',
        compact(
            'technicianPerformance',
            'startDate',
            'endDate',
            'filterStatus',
            'filterCategory'
        )
    )->setPaper('a4', 'landscape');

    if ($request->input('download') == 1) {
        return $pdf->download(
            'technician-performance-report.pdf'
        );
    }

    return $pdf->stream(
        'technician-performance-report.pdf'
    );
    }

    public function exportMaintenanceReport(Request $request)
{
    if (!session('admin_id')) {
        return redirect()
            ->route('admin.login')
            ->with('error', 'Please login first.');
    }

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $filterStatus = $request->input('status');
    $filterCategory = $request->input('category');

    $maintenanceReport = DB::table('maintenance_records')
        ->join(
            'assignments',
            'maintenance_records.assignments_id',
            '=',
            'assignments.assignments_id'
        )
        ->join(
            'complaints',
            'maintenance_records.complaint_id',
            '=',
            'complaints.complaint_id'
        )
        ->join(
            'users',
            'assignments.technician_id',
            '=',
            'users.user_id'
        )
        ->join(
            'facility_types',
            'complaints.facility_type_id',
            '=',
            'facility_types.facility_type_id'
        )
        ->when($startDate, function ($query) use ($startDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '>=',
                $startDate
            );
        })
        ->when($endDate, function ($query) use ($endDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '<=',
                $endDate
            );
        })
        ->when($filterStatus, function ($query) use ($filterStatus) {
            $query->where(
                'complaints.status',
                $filterStatus
            );
        })
        ->when($filterCategory, function ($query) use ($filterCategory) {
            $query->where(
                'complaints.facility_type_id',
                $filterCategory
            );
        })
        ->select(
            'complaints.complaint_code',
            'facility_types.facility_type_name',
            'users.name as technician_name',
            'complaints.priority',
            'assignments.assigned_at',
            'maintenance_records.completed_at',
            'complaints.status'
        )
        ->orderByDesc('maintenance_records.completed_at')
        ->get();

    $pdf = Pdf::loadView(
        'admin.reports-pdf.maintenance',
        compact(
            'maintenanceReport',
            'startDate',
            'endDate',
            'filterStatus',
            'filterCategory'
        )
    )->setPaper('a4', 'landscape');

    if ($request->input('download') == 1) {
        return $pdf->download(
            'maintenance-report.pdf'
        );
    }

    return $pdf->stream(
        'maintenance-report.pdf'
    );
    }

    public function exportRejectedComplaints(Request $request)
{
    if (!session('admin_id')) {
        return redirect()
            ->route('admin.login')
            ->with('error', 'Please login first.');
    }

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $filterStatus = $request->input('status');
    $filterCategory = $request->input('category');

    $rejectedComplaints = DB::table('complaints')
        ->join(
            'facility_types',
            'complaints.facility_type_id',
            '=',
            'facility_types.facility_type_id'
        )
        ->when($startDate, function ($query) use ($startDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '>=',
                $startDate
            );
        })
        ->when($endDate, function ($query) use ($endDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '<=',
                $endDate
            );
        })
        ->when($filterStatus, function ($query) use ($filterStatus) {
            $query->where(
                'complaints.status',
                $filterStatus
            );
        })
        ->when($filterCategory, function ($query) use ($filterCategory) {
            $query->where(
                'complaints.facility_type_id',
                $filterCategory
            );
        })
        ->where('complaints.status', 'rejected')
        ->select(
            'complaints.complaint_code',
            'complaints.issue_title',
            'facility_types.facility_type_name',
            'complaints.rejection_reason'
        )
        ->orderByDesc('complaints.submitted_at')
        ->get();

    $pdf = Pdf::loadView(
        'admin.reports-pdf.rejected-complaints',
        compact(
            'rejectedComplaints',
            'startDate',
            'endDate',
            'filterStatus',
            'filterCategory'
        )
    )->setPaper('a4', 'landscape');

    if ($request->input('download') == 1) {
        return $pdf->download(
            'rejected-complaints-report.pdf'
        );
    }

    return $pdf->stream(
        'rejected-complaints-report.pdf'
    );
    }


    public function exportUserFeedback(Request $request)
    {
    if (!session('admin_id')) {
        return redirect()
            ->route('admin.login')
            ->with('error', 'Please login first.');
    }

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $filterStatus = $request->input('status');
    $filterCategory = $request->input('category');

    $userFeedback = DB::table('feedback')
        ->join(
            'complaints',
            'feedback.complaint_id',
            '=',
            'complaints.complaint_id'
        )
        ->join(
            'facility_types',
            'complaints.facility_type_id',
            '=',
            'facility_types.facility_type_id'
        )
        ->when($startDate, function ($query) use ($startDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '>=',
                $startDate
            );
        })
        ->when($endDate, function ($query) use ($endDate) {
            $query->whereDate(
                'complaints.submitted_at',
                '<=',
                $endDate
            );
        })
        ->when($filterStatus, function ($query) use ($filterStatus) {
            $query->where(
                'complaints.status',
                $filterStatus
            );
        })
        ->when($filterCategory, function ($query) use ($filterCategory) {
            $query->where(
                'complaints.facility_type_id',
                $filterCategory
            );
        })
        ->select(
            'complaints.complaint_code',
            'facility_types.facility_type_name',
            'feedback.rating',
            'feedback.comment',
            'feedback.submitted_at'
        )
        ->orderByDesc('feedback.submitted_at')
        ->get();

    $pdf = Pdf::loadView(
        'admin.reports-pdf.user-feedback',
        compact(
            'userFeedback',
            'startDate',
            'endDate',
            'filterStatus',
            'filterCategory'
        )
    )->setPaper('a4', 'landscape');

    if ($request->input('download') == 1) {
        return $pdf->download(
            'user-feedback-report.pdf'
        );
    }

    return $pdf->stream(
        'user-feedback-report.pdf'
    );
    }

}