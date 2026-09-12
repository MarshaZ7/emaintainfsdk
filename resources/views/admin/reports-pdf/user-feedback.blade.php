<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>User Feedback Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        h2 {
            margin-bottom: 5px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 20px;
        }

        .filter {
            margin-bottom: 15px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .rating {
            color: #d89b00;
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #777;
        }
    </style>
</head>

<body>

    <h2>User Feedback Report</h2>

    <div class="subtitle">
        e-Maintain@FSDK
    </div>

    @if($startDate || $endDate || $filterStatus || $filterCategory)
        <div class="filter">
            <strong>Filter:</strong>

            @if($startDate)
                From {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
            @endif

            @if($endDate)
                to {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
            @endif

            @if($filterStatus)
                | Status: {{ ucwords(str_replace('_', ' ', $filterStatus)) }}
            @endif

            @if($filterCategory)
                | Category: {{ $filterCategory }}
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Complaint Code</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Submitted</th>
            </tr>
        </thead>

        <tbody>
            @forelse($userFeedback as $feedback)
                <tr>
                    <td>
                        {{ $feedback->complaint_code }}
                    </td>

                    <td>
                        {{ $feedback->facility_type_name }}
                    </td>

                    <td class="rating">
                        {{ $feedback->rating }}/5
                    </td>

                    <td>
                        {{ $feedback->comment ?: '-' }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($feedback->submitted_at)->format('d M Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty">
                        No user feedback available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>