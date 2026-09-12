@extends('layouts.fsdk-user.app')

@section('title', 'Complaint Detail')

@section('content')

<style>
    .complaint-detail-page {
        min-height: 100vh;
        background-color: #08005e;
        padding-top: 110px;
        padding-bottom: 60px;
    }

    .detail-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .back-button:hover {
        color: #dbeafe;
    }

    .detail-card {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .detail-header {
        padding: 28px 32px;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-header h3 {
        margin-bottom: 6px;
        font-weight: 700;
        color: #212529;
    }

    .complaint-code {
        color: #6c757d;
        font-size: 14px;
    }

    .detail-body {
        padding: 32px;
    }

    /* Section Title */
    .section-title1 {
        font-size: 20px;
        font-weight: 700;
        color: #212529;  
        margin-bottom: 10px;      
    }

    /* Section Divider */
    .detail-section {
        margin-top: 34px;
        padding-top: 28px;
        border-top: 1px solid #dee2e6;
    }

    /* First section inside content */
    .detail-section:first-of-type {
        margin-top: 32px;
    }

    /* Information Group */
    .info-group {
        background: #ffffff;
        border-radius: 10px;
    }

    /* Main information label */
    .detail-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 7px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .detail-value {
        color: #212529;
        font-size: 15px;
        font-weight: 500;
    }

    .detail-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 7px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .detail-value {
        color: #212529;
        font-size: 15px;
        font-weight: 500;
    }

    .detail-section {
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid #e9ecef;
    }

    .description-box {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 16px 18px;
        color: #495057;
        line-height: 1.7;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
        background-color: #e9ecef;
        color: #495057;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-assigned {
    background: #cfe2ff;
    color: #084298;
    }

    .status-in-progress {
        background: #cff4fc;
        color: #055160;
    }

    .status-resolved {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-rejected {
        background: #f8d7da;
        color: #842029;
    } 

    .photo-box {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
    }

    .photo-box img {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 8px;
    }

    .empty-photo {
        color: #6c757d;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .complaint-detail-page {
            padding-top: 90px;
        }

        .detail-header,
        .detail-body {
            padding: 22px;
        }
    }

   /* Feedback */
    .feedback-section {
        margin-top: 36px;
        padding: 32px;
        border-top: 1px solid #dee2e6;
        background: #f8f9ff;
        border-radius: 12px;
        text-align: center;
    }

    .feedback-title {
        font-size: 22px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 8px;
    }

    .feedback-subtitle {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 24px;
    }

    /* Star Rating */
    .star-rating {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 22px;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 48px;
        color: #d9dee3;
        cursor: pointer;
        line-height: 1;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .star-rating label:hover {
        color: #f5b301;
        transform: scale(1.12);
    }

    .star-rating label.active {
        color: #f5b301;
    }

    /* Feedback comment */
    .feedback-form-wrapper {
        max-width: 700px;
        margin: 0 auto;
        text-align: left;
    }

    .feedback-comment {
        min-height: 120px;
        resize: vertical;
    }

    /* Submitted feedback */
    .feedback-submitted {
        max-width: 650px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
    }

    .feedback-stars {
        color: #f5b301;
        font-size: 32px;
        letter-spacing: 4px;
        margin-bottom: 12px;
    }

    .feedback-comment-text {
        color: #495057;
        line-height: 1.7;
        margin-top: 10px;
        margin-bottom: 0;
    }
</style>

<section class="complaint-detail-page">
    <div class="container">
        <div class="detail-wrapper">

            {{-- Back Button --}}
            <a href="{{ route('user.complaints') }}" class="back-button">
                <i class="bi bi-arrow-left"></i>
                Back to My Complaints
            </a>

            {{-- Main Card --}}
            <div class="detail-card">

                {{-- Header --}}
                <div class="detail-header">
                    <h3>
                        Complaint Detail
                    </h3>
                    <div class="complaint-code">
                        {{ $complaint->complaint_code }}
                    </div>

                </div>

                {{-- Body --}}
                <div class="detail-body">
                <div>
                    <div class="section-title1">
                        Complaint Information
                    </div>                
                    <div class="row g-4">
                        <div class="col-md-6">
                            <span class="detail-label">
                                Issue Title
                            </span>

                            <div class="detail-value">
                                {{ $complaint->issue_title }}
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <span class="detail-label">
                                Category
                            </span>

                            <div class="detail-value">
                                {{ $complaint->facility_type_name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <span class="detail-label">
                                Location
                            </span>

                            <div class="detail-value">
                                {{ $complaint->location_name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <span class="detail-label">
                                Status
                            </span>
                            @php
                                $statusClass = match ($complaint->status) {
                                    'pending' => 'status-pending',
                                    'assigned' => 'status-assigned',
                                    'in_progress' => 'status-in-progress',
                                    'resolved' => 'status-resolved',
                                    'rejected' => 'status-rejected', 
                                    default => 'status-default',
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }} px-3 py-2">
                                {{ ucwords(str_replace(['_', '-'], ' ', $complaint->status)) }}
                            </span>
                        </div>

                        <div class="col-md-6">
                            <span class="detail-label">
                                Priority
                            </span>

                            <div class="detail-value">
                                {{ $complaint->priority
                                    ? ucfirst($complaint->priority)
                                    : '-' }}
                            </div>
                        </div>


                        {{-- Submitted --}}
                        <div class="col-md-6">
                            <span class="detail-label">
                                Submitted
                            </span>

                            <div class="detail-value">
                                {{ \Carbon\Carbon::parse($complaint->submitted_at)->format('d M Y, H:i') }}
                            </div>
                        </div>

                    </div>
                

                    {{-- Description --}}
                    <div class="detail-section">

                        <span class="detail-label">
                            Description
                        </span>

                        <div class="description-box">
                            {{ $complaint->issue_description }}
                        </div>

                    </div>


                    {{-- Supporting Evidence --}}
                    <div class="detail-section">

                        <span class="detail-label">
                            Supporting Evidence
                        </span>

                        @if($complaint->defect_photo)
                            <div class="photo-box">
                                <img src="{{ asset('storage/' . $complaint->defect_photo) }}"
                                alt="Complaint Evidence">
                            </div>
                        @else
                            <div class="photo-box">
                                <span class="empty-photo">
                                    No evidence photo uploaded.
                                </span>

                            </div>
                        @endif
                    </div>

                    @if($complaint->assignments_id)
                        <div class="detail-section">
                            <div class="section-title1">
                                Assignment Information
                            </div>                

                            <div class="row g-4">

                                {{-- Technician --}}
                                <div class="col-md-6">

                                    <span class="detail-label">
                                        Technician
                                    </span>

                                    <div class="detail-value">
                                        {{ $complaint->technician_name ?? '-' }}
                                    </div>

                                </div>
                        
                                <div class="col-md-6">
                                    <span class="detail-label">
                                        Assignment Status
                                    </span>

                                    <div class="detail-value">
                                        @if ($complaint->assignment_status)

                                            @php
                                                $assignmentStatus = $complaint->assignment_status;
                                            @endphp

                                            <span class="status-badge
                                                @if ($assignmentStatus === 'pending')
                                                    status-pending
                                                @elseif ($assignmentStatus === 'in_progress')
                                                    status-in-progress
                                                @elseif ($assignmentStatus === 'completed')
                                                    status-resolved
                                                @endif
                                            ">
                                                {{ ucwords(str_replace('_', ' ', $assignmentStatus)) }}
                                            </span>

                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-6">

                                    <span class="detail-label">
                                        Assigned At
                                    </span>
                                    <div class="detail-value">
                                        @if($complaint->assigned_at)
                                            {{ \Carbon\Carbon::parse($complaint->assigned_at)->format('d M Y, H:i') }}
                                        @else
                                            -
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif

                    
                    @if($complaint->status === 'resolved' && $complaint->completed_at)
                        <div class="detail-section">
                           <div class="section-title1">
                                Maintenance Information
                            </div>
                            <div class="row g-4">
                                {{-- Completed At --}}
                                <div class="col-md-6">

                                    <span class="detail-label">
                                        Completed At
                                    </span>

                                    <div class="detail-value">
                                        {{ \Carbon\Carbon::parse($complaint->completed_at)->format('d M Y, H:i') }}
                                    </div>
                                </div>

                                {{-- Maintenance Note --}}
                                <div class="col-12">
                                    <span class="detail-label">
                                        Maintenance Note
                                    </span>
                                    <div class="description-box">
                                        {{ $complaint->maintenance_note ?? '-' }}
                                    </div>
                                </div>

                                {{-- Completion Photo --}}
                                <div class="col-12">
                                    <span class="detail-label">
                                        Completion Photo
                                    </span>
                                    @if($complaint->completion_photo)
                                        <div class="photo-box">
                                            <img src="{{ asset('storage/' . $complaint->completion_photo) }}"
                                                alt="Maintenance Completion Photo">
                                        </div>
                                    @else
                                        <div class="photo-box">
                                            <span class="empty-photo">
                                                No completion photo available.
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Feedback --}}
                    @if($complaint->status === 'resolved')

                        <div class="feedback-section">

                            <div class="feedback-title">
                                Feedback
                            </div>

                            @if($feedback)

                                {{-- Feedback Already Submitted --}}
                                <p class="feedback-subtitle">
                                    Thank you for your feedback.
                                </p>

                                <div class="feedback-submitted">

                                    {{-- Rating --}}
                                    <div class="feedback-stars">

                                        @for($i = 1; $i <= 5; $i++)

                                            @if($i <= $feedback->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif

                                        @endfor

                                    </div>

                                    {{-- Comment --}}
                                    @if($feedback->comment)

                                        <p class="feedback-comment-text">
                                            {{ $feedback->comment }}
                                        </p>
                                    @else
                                        <p class="text-muted mb-0 mt-2">
                                            No comment provided.
                                        </p>
                                    @endif

                                    {{-- Date --}}
                                    <small class="text-muted d-block mt-3">
                                        Submitted:
                                        {{ \Carbon\Carbon::parse($feedback->submitted_at)->format('d M Y, H:i') }}
                                    </small>

                                </div>

                            @else

                                {{-- Feedback Form --}}
                                <p class="feedback-subtitle">
                                    How satisfied are you with the maintenance service?
                                </p>

                                <form
                                    method="POST"
                                    action="{{ route('user.complaints.feedback.store', $complaint->complaint_id) }}"
                                >

                                    @csrf

                                    {{-- Rating --}}
                                    <div class="mb-4">

                                        <label class="detail-label">
                                            Rating
                                        </label>

                                        <div class="star-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" id="rating{{ $i }}"
                                                    name="rating" value="{{ $i }}"
                                                    {{ old('rating') == $i ? 'checked' : '' }}>

                                                <label for="rating{{ $i }}" data-rating="{{ $i }}"
                                                    title="{{ $i }} star">
                                                    ★
                                                </label>
                                            @endfor
                                        </div>

                                        @error('rating')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Comment --}}
                                    <div class="mb-4">

                                        <label for="feedbackComment" class="detail-label">
                                            Comment
                                        </label>

                                        <textarea id="feedbackComment" name="comment"
                                        class="form-control feedback-comment"
                                        placeholder="Tell us about your experience...">{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <div class="text-danger small mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>


                                    {{-- Submit --}}
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send me-1"></i>
                                        Submit Feedback
                                    </button>

                                </form>

                            @endif

                        </div>

                    @endif

                    {{-- Rejection Information --}}
                    @if($complaint->status === 'rejected')
                        <div class="detail-section">
                            <div class="section-title1">
                                Rejection Information
                            </div>
                            <div class="alert alert-danger border-0 mb-0">
                                <div class="fw-semibold mb-1">
                                    Complaint Rejected
                                </div>
                                <div>
                                    {{ $complaint->rejection_reason ?? 'No rejection reason provided.' }}
                                </div>

                            </div>

                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const stars = document.querySelectorAll(
            '.star-rating label'
        );

        const ratingInputs = document.querySelectorAll(
            '.star-rating input'
        );

        stars.forEach(function (star) {

            star.addEventListener('click', function () {

                const rating = parseInt(
                    this.dataset.rating
                );

                // Aktifkan radio button yang sesuai
                const input = document.getElementById(
                    'rating' + rating
                );

                if (input) {
                    input.checked = true;
                }

                // Update warna bintang
                stars.forEach(function (item) {

                    const itemRating = parseInt(
                        item.dataset.rating
                    );

                    if (itemRating <= rating) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }

                });

            });

        });

        // Tampilkan kembali rating jika old('rating') tersedia
        ratingInputs.forEach(function (input) {

            if (input.checked) {

                const rating = parseInt(input.value);

                stars.forEach(function (star) {

                    const starRating = parseInt(
                        star.dataset.rating
                    );

                    if (starRating <= rating) {
                        star.classList.add('active');
                    }

                });

            }

        });

    });
</script>
@endsection