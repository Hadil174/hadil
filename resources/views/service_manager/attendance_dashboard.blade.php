<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('service_manager.css')
    <style type="text/css">
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ffffff;
            font-size: 26px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }

        .page-header h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #4299e1;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px 15px;
        }

        table.table {
            width: 100%;
            background-color: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            border-collapse: separate;
            border-spacing: 0;
            color: #e0e0e0;
        }

        table.table th, table.table td {
            padding: 12px 15px;
            text-align: left;
        }

        table.table thead th {
            border-bottom: 2px solid #4299e1;
            font-weight: 600;
        }

        table.table tbody tr:hover {
            background-color: #2a2a2a;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .bg-danger {
            background-color: #e53e3e;
            color: white;
        }

        .bg-success {
            background-color: #38a169;
            color: white;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px 10px;
            }

            table.table th, table.table td {
                padding: 8px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    @include('service_manager.header')
    @include('service_manager.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container">
                <h2>Employee Attendance for {{ $today }}</h2>
            </div>
        </div>

        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Check-in Time</th>
                        <th>Check-out Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        @php
                            $attendance = $employee->attendance->first(); // Today's attendance or null
                        @endphp
                        <tr>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $attendance ? $attendance->check_in : '-' }}</td>
                            <td>{{ $attendance ? ($attendance->check_out ?? '-') : '-' }}</td>
                            <td>
                                @if ($attendance)
                                    @if ($attendance->check_out)
                                        <span class="badge bg-success">Checked Out</span>
                                    @else
                                        <span class="badge bg-success">Checked In</span>
                                    @endif
                                @else
                                    <span class="badge bg-danger">Absent</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('service_manager.footer')
</body>
</html>
