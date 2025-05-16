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
            background-color: #414040;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.6);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            color: #e0e0e0;
        }

        .table th,
        .table td {
            padding: 10px 12px;
            border-bottom: 1px solid #333;
            text-align: left;
            white-space: nowrap;
        }

        .table th {
            background-color: #2a2a2a;
            color: #f5f5f5;
        }

        .table tbody tr:hover {
            background-color: #2c2c2c;
        }

        .table img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-warning {
            background-color: #f39c12;
            color: black;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
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

        .header-actions .btn-add {
            background-color: #27ae60;
            color: white;
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <div class="table-container">
                <div class="header-actions">
                    <form method="GET" action="{{ url('view_employee') }}" class="d-flex" style="display: flex; gap: 10px;">
                        <input type="text" name="search" placeholder="Search by name, role..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <a href="{{ url('manage_employee') }}" class="btn btn-add">+ Add Employee</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th> <!-- Added ID column -->
                            <th>Photo</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Hire Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td> <!-- Show ID -->
                                <td>
                                    @if ($employee->profile_picture)
                                        <img src="{{ asset('employee_profiles/' . $employee->profile_picture) }}" alt="Profile Picture">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ $employee->role }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->hire_date }}</td>
                                <td>{{ $employee->employment_status }}</td>
                                <td class="actions">
                                    <a href="{{ url('employee_update', $employee->id) }}" class="btn btn-warning">Update</a>
                                    <a href="{{ url('employee_delete', $employee->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Optional: Add pagination --}}
                {{-- {{ $data->links() }} --}}
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
