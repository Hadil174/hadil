<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }

        .container-fluid {
            padding: 30px;
        }

        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .table th, .table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
            white-space: nowrap;
        }

        .table th {
            background-color: #f1f3f5;
            color: #333;
        }

        .table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .header-actions input {
            padding: 6px;
            font-size: 13px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .header-actions .btn-add {
            background-color: #28a745;
            color: white;
        }

        .btn {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
        }

    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h2>All Salaries</h2>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salaries as $salary)
                        @if($salary->employee)
                            <tr>
                                <td>{{ $salary->employee->first_name }} {{ $salary->employee->last_name }}</td>
                                <td>${{ $salary->amount }}</td>
                                <td>{{ $salary->payment_date }}</td>
                                <td>{{ $salary->notes }}</td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
