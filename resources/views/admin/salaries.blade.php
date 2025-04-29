<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style type="text/css">
        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 100%;
            text-align: center;
            margin-top: 40px;
        }
        .th_deg{
            background-color: rgb(248, 209, 161);
            padding: 10px;

        }
        tr{
            border: 3px solid white ;
        }
        td{
            padding: 10px;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2>All Salaries</h2>
                <table border="1" cellpadding="8">
                    <thead>
                        <tr>
                            <th class="th_deg">Employee</th>
                            <th  class="th_deg">Amount</th>
                            <th  class="th_deg">Payment Date</th>
                            <th  class="th_deg">Note</th>
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
