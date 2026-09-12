<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Maintenance Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0 0 5px 0;
        }

        .header p {
            margin: 0;
            color: #666;
        }

        .filter {
            margin-bottom: 15px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 7px;
            text-align: center;
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #777;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Maintenance Report</h2>
        <p>e-Maintain@FSDK</p>
    </div>

    <div class="filter">
        <strong>Filter:</strong>

        @if($startDate)
            Start Date: {{ $startDate }}
        @endif

        @if($endDate)
            &nbsp; | &nbsp; End Date: {{ $endDate }}
        @endif

        @if($filterStatus)
            &nbsp; | &nbsp; Status:
            {{ ucwords(str_replace('_', ' ', $filterStatus)) }}
        @endif

        @if($filterCategory)
            &nbsp; | &nbsp; Category: Filtered
        @endif

        @if(!$startDate && !$endDate && !$filterStatus && !$filterCategory)
            All Data
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Complaint Code</th>
                <th>Category</th>
                <th>Technician</th>
                <th>Priority</th>
                <th>Assigned Date</th>
                <th>Completed Date</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($maintenanceReport as $index => $maintenance)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>
                        {{ $maintenance->complaint_code }}
                    </td>

                    <td>
                        {{ $maintenance->facility_type_name }}
                    </td>

                    <td>
                        {{ $maintenance->technician_name }}
                    </td>

                    <td>
                        {{ ucwords($maintenance->priority) }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($maintenance->assigned_at)->format('d M Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($maintenance->completed_at)->format('d M Y') }}
                    </td>

                    <td>
                        {{ ucwords(str_replace('_', ' ', $maintenance->status)) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty">
                        No maintenance records available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generated from e-Maintain@FSDK
    </div>

</body>
</html>