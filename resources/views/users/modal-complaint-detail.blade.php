<!-- Complaint Detail Modal -->
<div class="modal fade" id="complaintDetailModal" tabindex="-1" aria-labelledby="complaintDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold" id="complaintDetailModalLabel">
                        Complaint Detail
                    </h5>
                    <small class="text-muted" id="modalComplaintId"></small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body">

                <div class="row g-4">

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">
                            Issue Title
                        </small>
                        <strong id="modalIssueTitle">
                            -
                        </strong>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">
                            Category
                        </small>
                        <span id="modalCategory">
                            -
                        </span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">
                            Location
                        </small>
                        <span id="modalLocation">
                            -
                        </span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">
                            Status
                        </small>
                        <span id="modalStatus" class="status-badge">
                            -
                        </span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">
                            Submitted
                        </small>
                        <span id="modalSubmitted">
                            -
                        </span>
                    </div>

                    <div class="col-12">
                        <small class="text-muted d-block mb-1">
                            Description
                        </small>
                        <div class="p-3 bg-light rounded">
                            <span id="modalDescription">
                                -
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <small class="text-muted d-block mb-1">
                            Supporting Evidence
                        </small>

                        <div id="modalEvidenceContainer" class="mt-2">
                            <span class="text-muted">
                                No evidence photo uploaded.
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>