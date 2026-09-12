<div class="modal fade" id="complaintDetailModal" tabindex="-1" aria-labelledby="complaintDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <!-- Header -->
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold" id="complaintDetailModalLabel">
                        Complaint Detail
                    </h5>
                    <small class="text-muted" id="modalComplaintId"></small>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Reporter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-user me-2 text-primary"></i>
                        Reporter Information
                    </h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Name
                            </small>
                            <span class="fw-semibold" id="modalReporter">
                                -
                            </span>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                University ID
                            </small>
                            <span class="fw-semibold" id="modalUniversityId">
                                -
                            </span>
                        </div>

                        <div class="col-md-12">
                            <small class="text-muted d-block">
                                Email
                            </small>
                            <span class="fw-semibold" id="modalEmail">
                                -
                            </span>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Complaint Information -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-clipboard-list me-2 text-primary"></i>
                        Complaint Information
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Issue Title
                            </small>
                            <span class="fw-semibold" id="modalIssueTitle">
                                -
                            </span>
                        </div>

                        <div class="col-md-4">
                            <small class="text-muted d-block">
                                Status
                            </small>
                            <span id="modalStatus">
                                -
                            </span>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Priority
                            </small>

                            <form id="priorityForm" method="POST" class="d-flex align-items-center gap-2 mt-1">
                                @csrf
                                <select name="priority" id="modalPriority"
                                    class="form-select form-select-sm"
                                    style="max-width: 180px;">
                                    <option value="">
                                        Select Priority
                                    </option>

                                    <option value="low">
                                        Low
                                    </option>

                                    <option value="medium">
                                        Medium
                                    </option>

                                    <option value="high">
                                        High
                                    </option>

                                </select>

                                <button type="submit"
                                    class="btn btn-sm btn-primary">
                                    Save
                                </button>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Facility Type
                            </small>
                            <span class="fw-semibold" id="modalCategory">
                                -
                            </span>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Location
                            </small>
                            <span class="fw-semibold" id="modalLocation">
                                -
                            </span>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                Submitted
                            </small>
                            <span class="fw-semibold" id="modalSubmitted">
                                -
                            </span>
                        </div>

                        <div class="col-md-12">
                            <small class="text-muted d-block mb-2">
                                Description
                            </small>

                            <div class="bg-light rounded p-3">
                                <span id="modalDescription">
                                    -
                                </span>
                            </div>
                        </div>

                        <!-- Supporting Evidence -->
                        <div class="col-md-12">
                            <small class="text-muted d-block mb-2">
                                Supporting Evidence
                            </small>

                            <div id="modalEvidenceContainer" class="bg-light rounded p-3 text-center">
                                <span class="text-muted">
                                    No evidence photo uploaded.
                                </span>
                            </div>
                        </div>

                        {{-- Rejection Information --}}
                        <div class="col-md-12 mt-3" id="rejectionInfoSection">
                            <div class="border-top pt-3">
                                <small class="text-muted d-block mb-2">
                                    Rejection Reason
                                </small>
                                <div class="bg-danger-subtle text-danger rounded p-3">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                                        <span id="modalRejectionReason">
                                            -
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assignment Shortcut -->
                        <div class="col-md-12 mt-3" id="assignmentSection">
                            <div class="border-top pt-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-muted d-block mb-1">
                                            Assignment
                                        </small>

                                        <span class="fw-semibold">
                                            View technician assignment and maintenance details.
                                        </span>
                                    </div>
                                    <a href="#" id="viewAssignmentButton" class="btn btn-primary">
                                        <i class="fas fa-tools me-1"></i>
                                        View Assignment Detail
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Reject Complaint --}}
                        <div class="col-md-12 mt-3" id="rejectSection">
                            <div class="border-top pt-3">
                                <button type="button" class="btn btn-danger" id="rejectComplaintButton"
                                    data-bs-toggle="modal" data-bs-target="#rejectComplaintModal">
                                    <i class="fas fa-times-circle me-1"></i>
                                    Reject Complaint
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
{{-- Reject Complaint Modal --}}
<div class="modal fade" id="rejectComplaintModal" tabindex="-1"
    aria-labelledby="rejectComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold" id="rejectComplaintModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                        Reject Complaint
                    </h5>

                    <small class="text-muted">
                        Please provide a reason for rejecting this complaint.
                    </small>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>


            <form id="rejectComplaintForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="mb-3">
                        Are you sure you want to reject this complaint?
                    </p>
                    <div class="mb-3">
                        <label for="rejectionReason" class="form-label fw-semibold">
                            Rejection Reason
                            <span class="text-danger">*</span>
                        </label>

                        <textarea name="rejection_reason" id="rejectionReason" class="form-control"
                            rows="4" placeholder="Enter the reason for rejecting this complaint..."
                            required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times-circle me-1"></i>
                        Reject Complaint
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>