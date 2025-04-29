<!DOCTYPE html>
<html>
<head>
    <title>Add Salary</title>
    @include('admin.css')
    <style type="text/css">
        label{
            display: inline-block;
            width: 200px;
        }
        .div_deg{
            padding-top: 30px;
        }
        .div_centre{
            text-align: center;
            padding-top: 40px;
        }
       
        </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
        <h2>Add Salary Details</h2>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <form action="{{ url('/add_salary') }}" method="POST">
            @csrf
            <div>
                <label for="employee_id">Employee:</label>
                <select name="employee_id" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="amount">Amount:</label>
                <input type="number" name="amount" step="0.01" required>
            </div>

            <div>
                <label for="payment_date">Payment Date:</label>
                <input type="date" name="payment_date" required>
            </div>

            <div>
                <label for="payment_method">Payment Method:</label>
                <input type="text" name="payment_method">
            </div>

            <div>
                <label for="notes">Notes:</label>
                <textarea name="notes"></textarea>
            </div>

            <button type="submit">Add Salary</button>
        </form>
    </div>
  </div>
  </div>

    @include('admin.footer')
</body>
</html>
