<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style type="text/css">
        body {
            background: #121212;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e0e0e0;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 10px;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .notification-card {
            background: #1e1e1e;
            border-left: 6px solid #00bcd4;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.6);
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .notification-card:hover {
            background-color: #2a2a2a;
        }

        .notification-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            color: #00bcd4;
        }

        .notification-header {
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
        }

        .notification-meta {
            font-size: 13px;
            color: #aaa;
            margin-bottom: 10px;
        }

        .notification-message {
            font-size: 14px;
            color: #cccccc;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
        }

        .btn-sm {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 4px;
            background: #e53935;
            color: #fff;
            border: none;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .btn-sm:hover {
            background: #c62828;
        }

        .alert-success {
            text-align: center;
            padding: 10px;
            background: #2e7d32;
            color: #fff;
            border: 1px solid #1b5e20;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container">
            <div class="page-title">🔔 Guest Messages</div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @foreach ($data as $data)
                <div class="notification-card">
                    <div class="notification-icon"><i class="fas fa-bell"></i></div>
                    <div class="notification-header">{{ $data->name }}</div>
                    <div class="notification-meta">{{ $data->email }} • {{ $data->phone }}</div>
                    <div class="notification-message">{{ Str::limit($data->message, 120) }}</div>
                    <div class="btn-group">
                        <a href="{{ url('contact_delete', $data->id) }}" class="btn-sm">🗑️ Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
