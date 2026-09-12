<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    public function login()
    {
        // Jika sudah login sebagai technician
        if (session('technician_id')) {
            return redirect()->route('technician.dashboard');
        }

        return view('technician.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->where('users.email', $request->email)
            ->where('roles.role_name', 'technician')
            ->where('users.status', 'active')
            ->select(
                'users.*',
                'roles.role_name'
            )
            ->first();

        // Jika akun tidak ditemukan
        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Invalid technician account.');
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Incorrect email or password.');
        }

        // Hapus session login sebelumnya
        $request->session()->regenerate();

        // Simpan session technician
        session([
            'technician_id' => $user->user_id,
            'technician_name' => $user->name,
            'technician_email' => $user->email,
            'technician_university_id' => $user->university_id,
            'technician_role' => $user->role_name,
        ]);

        return redirect()
            ->route('technician.dashboard')
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'technician_id',
            'technician_name',
            'technician_email',
            'technician_university_id',
            'technician_role',
        ]);

        $request->session()->regenerateToken();

        return redirect()
            ->route('technician.login')
            ->with('success', 'You have been logged out successfully.');
    }

    //dashboard
    public function dashboard()
    {
    if (!session('technician_id')) {
        return redirect()
            ->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    // Total assignments milik technician yang sedang login
    $totalAssignments = DB::table('assignments')
        ->where('technician_id', $technicianId)
        ->count();

    // Pending assignments
    $pendingAssignments = DB::table('assignments')
        ->where('technician_id', $technicianId)
        ->where('assignment_status', 'pending')
        ->count();

    // In Progress assignments
    $inProgressAssignments = DB::table('assignments')
        ->where('technician_id', $technicianId)
        ->where('assignment_status', 'in_progress')
        ->count();

    // Completed assignments
    $completedAssignments = DB::table('assignments')
        ->where('technician_id', $technicianId)
        ->where('assignment_status', 'completed')
        ->count();

    // 5 assignment terbaru milik technician
    $recentAssignments = DB::table('assignments')
        ->join(
            'complaints',
            'assignments.complaint_id',
            '=',
            'complaints.complaint_id'
        )
        ->join(
            'locations',
            'complaints.location_id',
            '=',
            'locations.location_id'
        )
        ->select(
            'assignments.assignments_id',
            'assignments.assignment_status',
            'assignments.assigned_at',
            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.priority',
            'locations.location_name'
        )
        ->where('assignments.technician_id', $technicianId)
        ->orderBy('assignments.assigned_at', 'desc')
        ->limit(5)
        ->get();

    return view('technician.dashboard', compact(
        'totalAssignments',
        'pendingAssignments',
        'inProgressAssignments',
        'completedAssignments',
        'recentAssignments'
    ));
    }
   
    public function assignments(Request $request)
    {
    //check login
    if (!session('technician_id')) {
        return redirect()
            ->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    // Get value search dan filter
    $search = $request->input('search');
    $status = $request->input('status');
    $priority = $request->input('priority');

    // Query assignments
    $query = DB::table('assignments')
        ->join(
            'complaints',
            'assignments.complaint_id',
            '=',
            'complaints.complaint_id'
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
            'assignments.complaint_id',
            'assignments.assigned_at',
            'assignments.assignment_status',
            'assignments.assignment_note',

            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.priority',

            'locations.location_name',

            'facility_types.facility_type_name'
        )
        ->where('assignments.technician_id', $technicianId);

    // Search
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('complaints.complaint_code', 'like', '%' . $search . '%')
                ->orWhere('complaints.issue_title', 'like', '%' . $search . '%')
                ->orWhere('locations.location_name', 'like', '%' . $search . '%')
                ->orWhere('facility_types.facility_type_name', 'like', '%' . $search . '%');
        });
    }

    // Filter Status
    if ($status && $status !== 'all') {
        $query->where(
            'assignments.assignment_status',
            $status
        );
    }

    // Filter Priority
    if ($priority && $priority !== 'all') {
        $query->where(
            'complaints.priority',
            $priority
        );
    }

    // Shorting dan pagination
    $assignments = $query
        ->orderBy('assignments.assigned_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('technician.assignments', compact(
        'assignments',
        'search',
        'status',
        'priority'
    ));
    }

    public function assignmentDetail($id)
    {
    // Check technician login
    if (!session('technician_id')) {
        return redirect()
            ->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    // Get assignment detail
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
            'users as admins',
            'assignments.admin_id',
            '=',
            'admins.user_id'
        )
        ->join(
            'users as complainants',
            'complaints.user_id',
            '=',
            'complainants.user_id'
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

            // Complainant
            'complainants.name as complainant_name',
            'complainants.email as complainant_email',
            'complainants.university_id as complainant_university_id',

            // Technician
            'technicians.name as technician_name',

            // Admin
            'admins.name as admin_name',

            // Location
            'locations.location_name',
            'locations.description as location_description',

            // Facility
            'facility_types.facility_type_name'
        )
        ->where('assignments.assignments_id', $id)
        ->where('assignments.technician_id', $technicianId)
        ->first();

    // Assignment not found or does not belong to this technician
    if (!$assignment) {
        return redirect()
            ->route('technician.assignments')
            ->with('error', 'Assignment not found.');
    }

    return view('technician.assignment-detail', compact('assignment'));
    }

    public function startAssignment($id)
{
    if (!session('technician_id')) {
        return redirect()->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    $assignment = DB::table('assignments')
        ->where('assignments_id', $id)
        ->where('technician_id', $technicianId)
        ->where('assignment_status', 'pending')
        ->first();

    if (!$assignment) {
        return redirect()->route('technician.assignments')
            ->with('error', 'Assignment cannot be started.');
    }

    DB::transaction(function () use ($id, $assignment) {
        
        DB::table('assignments')
            ->where('assignments_id', $id)
            ->update([
                'assignment_status' => 'in_progress'
            ]);

        // Ubah status complaint
        DB::table('complaints')
            ->where('complaint_id', $assignment->complaint_id)
            ->where('status', 'assigned')
            ->update([
                'status' => 'in_progress'
            ]);
    });

    return redirect()
        ->route('technician.assignment.detail', $id)
        ->with('success', 'Assignment started successfully.');
    }

    public function maintenanceRecords()
    {
    if (!session('technician_id')) {
        return redirect()->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    // Get maintenance records belonging to the logged-in technician
    $records = DB::table('maintenance_records')
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
            'maintenance_records.maintenance_id',
            'maintenance_records.assignments_id',
            'maintenance_records.complaint_id',
            'maintenance_records.completion_photo',
            'maintenance_records.maintenance_note',
            'maintenance_records.completed_at',

            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.priority',

            'locations.location_name',

            'facility_types.facility_type_name'
        )
        ->where('assignments.technician_id', $technicianId)
        ->orderBy('maintenance_records.completed_at', 'desc')
        ->get();

    // Statistics
    $totalRecords = $records->count();

    $completedRecords = $records->whereNotNull('completed_at')->count();

    $thisMonth = $records->filter(function ($record) {
        return \Carbon\Carbon::parse($record->completed_at)->isCurrentMonth();
    })->count();

    return view(
        'technician.maintenance-records',
        compact(
            'records',
            'totalRecords',
            'completedRecords',
            'thisMonth'
        )
    );
    }
    public function createMaintenanceRecord($id)
{
    if (!session('technician_id')) {
        return redirect()->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    $assignment = DB::table('assignments')
        ->join('complaints', 'assignments.complaint_id', '=', 'complaints.complaint_id')
        ->join('locations', 'complaints.location_id', '=', 'locations.location_id')
        ->join('facility_types', 'complaints.facility_type_id', '=', 'facility_types.facility_type_id')
        ->select(
            'assignments.assignments_id',
            'assignments.complaint_id',
            'assignments.assignment_status',
            'assignments.assignment_note',
            'assignments.assigned_at',

            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.issue_description',
            'complaints.priority',
            'complaints.defect_photo',

            'locations.location_name',
            'locations.description as location_description',

            'facility_types.facility_type_name'
        )
        ->where('assignments.assignments_id', $id)
        ->where('assignments.technician_id', $technicianId)
        ->where('assignments.assignment_status', 'in_progress')
        ->first();

    if (!$assignment) {
        return redirect()->route('technician.assignments')
            ->with('error', 'Assignment cannot be completed.');
    }

    return view(
        'technician.maintenance-record-create',
        compact('assignment')
    );
    }

    public function storeMaintenanceRecord(Request $request, $id)
    {
    if (!session('technician_id')) {
        return redirect()->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    $request->validate([
        'maintenance_note' => 'required|string',
        'completion_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
    ]);

    $assignment = DB::table('assignments')
        ->where('assignments_id', $id)
        ->where('technician_id', $technicianId)
        ->where('assignment_status', 'in_progress')
        ->first();

    if (!$assignment) {
        return redirect()->route('technician.assignments')
            ->with('error', 'Assignment cannot be completed.');
    }

    $photoPath = $request->file('completion_photo')
        ->store('maintenance', 'public');

    DB::transaction(function () use (
        $assignment,
        $photoPath,
        $request,
        $id
    ) {

        $now = now();

        // 1. Create maintenance record
        DB::table('maintenance_records')->insert([
            'assignments_id' => $id,
            'complaint_id' => $assignment->complaint_id,
            'completion_photo' => $photoPath,
            'maintenance_note' => $request->maintenance_note,
            'completed_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 2. Update assignment status
        DB::table('assignments')
            ->where('assignments_id', $id)
            ->where('assignment_status', 'in_progress')
            ->update([
                'assignment_status' => 'completed',
            ]);

        // 3. Update complaint status
        DB::table('complaints')
            ->where('complaint_id', $assignment->complaint_id)
            ->where('status', 'in_progress')
            ->update([
                'status' => 'resolved',
            ]);
    });

    return redirect()
        ->route('technician.maintenance.records')
        ->with(
            'success',
            'Maintenance record created and assignment completed successfully.'
        );
    }

    public function maintenanceRecordDetail($id)
    {
    if (!session('technician_id')) {
        return redirect()->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    $record = DB::table('maintenance_records')
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
            'maintenance_records.maintenance_id',
            'maintenance_records.assignments_id',
            'maintenance_records.complaint_id',
            'maintenance_records.completion_photo',
            'maintenance_records.maintenance_note',
            'maintenance_records.completed_at',

            'assignments.assignment_status',
            'assignments.assignment_note',
            'assignments.assigned_at',

            'complaints.complaint_code',
            'complaints.issue_title',
            'complaints.issue_description',
            'complaints.priority',
            'complaints.defect_photo',
            'complaints.submitted_at',

            'locations.location_name',
            'locations.description as location_description',

            'facility_types.facility_type_name'
        )
        ->where('maintenance_records.maintenance_id', $id)
        ->where('assignments.technician_id', $technicianId)
        ->first();

    if (!$record) {
        return redirect()
            ->route('technician.maintenance.records')
            ->with('error', 'Maintenance record not found.');
    }

    return view(
        'technician.maintenance-record-detail',
        compact('record')
    );
    }

    public function reports()
{
    if (!session('technician_id')) {
        return redirect()
            ->route('technician.login')
            ->with('error', 'Please login first.');
    }

    $technicianId = session('technician_id');

    // Statistics
    $totalAssignments = DB::table('assignments')
        ->where('technician_id', $technicianId)
        ->count();

    $completedAssignments = DB::table('assignments')
        ->where('technician_id', $technicianId)
        ->where('assignment_status', 'completed')
        ->count();

    $inProgressAssignments = DB::table('assignments')
        ->where('technician_id', $technicianId)
        ->where('assignment_status', 'in_progress')
        ->count();

    $maintenanceRecords = DB::table('maintenance_records')
        ->join(
            'assignments',
            'maintenance_records.assignments_id',
            '=',
            'assignments.assignments_id'
        )
        ->where('assignments.technician_id', $technicianId)
        ->count();

    // Completion rate
    $completionRate = $totalAssignments > 0
        ? round(($completedAssignments / $totalAssignments) * 100)
        : 0;

    // Recent maintenance activity
    $recentActivities = DB::table('maintenance_records')
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
            'locations',
            'complaints.location_id',
            '=',
            'locations.location_id'
        )
        ->select(
            'maintenance_records.maintenance_id',
            'maintenance_records.completed_at',
            'complaints.complaint_code',
            'locations.location_name'
        )
        ->where('assignments.technician_id', $technicianId)
        ->orderBy('maintenance_records.completed_at', 'desc')
        ->limit(10)
        ->get();

    return view(
        'technician.reports',
        compact(
            'totalAssignments',
            'completedAssignments',
            'inProgressAssignments',
            'maintenanceRecords',
            'completionRate',
            'recentActivities'
        )
    );
    }
}