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
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
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
                >

                <table class="table">
                    <thead>
                        <tr>
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
