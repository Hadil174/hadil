<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style type="text/css">
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #353434;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
            color: #e0e0e0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #cfd8dc;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: #e0e0e0;
            box-sizing: border-box;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #4caf50;
            outline: none;
            background-color: #3a3a3a;
        }

        .btn-submit {
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #388e3c;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h2>Add Salary</h2>

            <div class="form-container">
                <form action="{{ url('admin/add_salary') }}" method="POST">
                    @csrf
                    <!-- Employee Selection -->
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" required>
                            <option value="" disabled selected>Select an Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" required>
                    </div>

                    <!-- Payment Date -->
                    <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" required>
                    </div>

                    <!-- Notes -->
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" rows="4"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">Add Salary</button>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
