<!DOCTYPE html>
<html>
<head>
    <base href="/public">
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

        .form-container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            max-width: 700px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.6);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: #e0e0e0;
            margin-bottom: 15px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        .btn-submit {
            display: inline-block;
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-submit:hover {
            background-color: #1f8c4a;
        }

        .alert-success {
            background-color: #2e7d32;
            color: #d4edda;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <div class="form-container">
                <h1>Update Employee</h1>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('edit_employee', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $data->first_name) }}" required>

                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $data->last_name) }}" required>

                    <label for="email">Email</label>
                    <textarea id="email" name="email" rows="3" required>{{ $data->email }}</textarea>

                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="phone" step="0.01" value="{{ $data->phone }}" required>

                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $data->address) }}" required>

                    <label for="department">Department</label>
                    <input type="text" id="department" name="department" value="{{ old('department', $data->department) }}" required>

                    <label for="hire_date">Hire Date</label>
                    <input type="date" id="hire_date" name="hire_date" value="{{ old('hire_date', $data->hire_date) }}" required>

                    <label for="employment_status">Employment Status</label>
                    <input type="text" id="employment_status" name="employment_status" value="{{ old('employment_status', $data->employment_status) }}" required>

                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

                    <button type="submit" class="btn-submit">Update Employee</button>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
