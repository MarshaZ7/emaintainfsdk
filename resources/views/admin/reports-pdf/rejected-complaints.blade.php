<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Rejected Complaints Report</title>

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

        .empty {
            text-align: center;
            padding: 20px;
            color: #777;
        }
    </style>
</head>

<body>

    <h2>Rejected Complaints Report</h2>

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
                <th>Issue</th>
                <th>Category</th>
                <th>Rejection Reason</th>
            </tr>
        </thead>

        <tbody>
            @forelse($rejectedComplaints as $complaint)
                <tr>
                    <td>
                        {{ $complaint->complaint_code }}
                    </td>

                    <td>
                        {{ $complaint->issue_title }}
                    </td>

                    <td>
                        {{ $complaint->facility_type_name }}
                    </td>

                    <td>
                        {{ $complaint->rejection_reason ?: '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">
                        No rejected complaints available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>