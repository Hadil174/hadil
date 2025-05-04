<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style type="text/css">
        body {
            background: #f6f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;  /* Wider container to accommodate more cards */
            margin: 30px auto;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;  /* Allow wrapping to the next row */
            justify-content: space-between;  /* Distribute cards evenly */
        }

        .message-card {
            background: linear-gradient(to right, #ffffff, #fff7ed);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.06);
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
            transition: transform 0.2s ease;
            width: 30%;  /* Adjust width to fit 3 cards per row */
            margin-bottom: 20px; /* Margin for bottom spacing between rows */
        }

        .message-card:hover {
            transform: scale(1.02);
        }

        .message-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 22px;
            color: #f5a623;
        }

        .message-header {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .message-subheader {
            font-size: 12px;
            color: #777;
            margin-bottom: 8px;
        }

        .message-content {
            font-size: 14px;
            color: #444;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-sm {
            padding: 5px 8px;
            font-size: 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #d9534f;
            color: #fff;
        }

        .page-title {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #222;
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
            <div class="page-title">📩 </div>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            @foreach ($data as $data)
                <div class="message-card">
                    <div class="message-icon"><i class="fas fa-envelope-open-text"></i></div>
                    <div class="message-header">{{ $data->name }}</div>
                    <div class="message-subheader">{{ $data->email }} • {{ $data->phone }}</div>
                    <div class="message-content">{{ Str::limit($data->message, 100) }}</div>
                    <div class="btn-group">
                        <a href="{{ url('contact_delete', $data->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
