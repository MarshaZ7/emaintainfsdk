<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Technician Performance Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
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
            font-size: 11px;
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
            padding: 8px;
            text-align: center;
        }

        td:first-child,
        th:first-child {
            text-align: left;
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            color: #777;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Technician Performance Report</h2>
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
                <th>Technician</th>
                <th>Total Assignments</th>
                <th>Completed</th>
                <th>In Progress</th>
                <th>Pending</th>
                <th>Completion Rate</th>
            </tr>
        </thead>

        <tbody>
            @forelse($technicianPerformance as $index => $technician)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>
                        {{ $technician->technician_name }}
                    </td>

                    <td>
                        {{ $technician->total_assignments }}
                    </td>

                    <td>
                        {{ $technician->completed }}
                    </td>

                    <td>
                        {{ $technician->in_progress }}
                    </td>

                    <td>
                        {{ $technician->pending }}
                    </td>

                    <td>
                        {{ $technician->completion_rate }}%
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">
                        No technician data available.
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