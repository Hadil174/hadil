<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
        }

        .container-fluid {
            padding: 30px;
        }

        .table-container {
            background-color: #4d4c4c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.8);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            color: #e0e0e0;
        }

        .table th, .table td {
            padding: 10px 12px;
            border-bottom: 1px solid #333;
            text-align: left;
            white-space: nowrap;
        }

        .table th {
            background-color: #2c2c2c;
            color: #a0a0a0;
        }

        .table tbody tr:hover {
            background-color: #333333;
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
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: #e0e0e0;
        }

        .btn-add {
            background-color: #4caf50;
            color: white;
            padding: 7px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-add:hover {
            background-color: #388e3c;
        }

        .btn {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #e0e0e0;
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
            <div class="header-actions">
                <h2>All Salaries</h2>
               
            </div>

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
                                <td>{{ $salary->amount }}DA</td>
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
