<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('admin.css')
    @include('admin.header')
    <style type="text/css">
        :root {
            --primary-color: #3a3a3a;
            --secondary-color: #2d2d2d;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --text-color: #e0e0e0;
            --border-color: #333333;
            --success-color: #76b873;
            --error-color: #f72585;
            --muted-text: #888888;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        .page-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            margin-left: 250px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--text-color);
            text-align: center;
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: #2a2a2a;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #555;
            box-shadow: 0 0 0 3px rgba(85, 85, 85, 0.3);
            background-color: #333;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 6px;
        }

        .alert-success {
            background-color: rgba(76, 201, 240, 0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
        }

        .alert-danger {
            background-color: rgba(247, 37, 133, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
        }

        .alert ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        .text-muted {
            color: var(--muted-text);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')
       
    <div class="page-container">
        <div class="main-content">
            <div class="card">
                <h1 class="card-title">Send Email Notification</h1>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('send_mail', $data->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="greeting" class="form-label">Greeting</label>
                        <input type="text" id="greeting" name="greeting" class="form-control" 
                               value="{{ old('greeting') }}" placeholder="e.g., Dear Customer" required>
                    </div>

                    <div class="form-group">
                        <label for="body" class="form-label">Message Body</label>
                        <textarea id="body" name="body" class="form-control" required>{{ old('body') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="action_text" class="form-label">Action Button Text (Optional)</label>
                        <input type="text" id="action_text" name="actionText" class="form-control" 
                               value="{{ old('actionText') }}" placeholder="e.g., View Offer">
                    </div>

                    <div class="form-group">
                        <label for="action_url" class="form-label">Action URL (Optional)</label>
                        <input type="url" id="action_url" name="actionURL" class="form-control" 
                               value="{{ old('actionURL', 'https://') }}" 
                               placeholder="https://example.com/offer">
                        <small class="text-muted">Leave blank if no action button needed</small>
                    </div>

                    <div class="form-group">
                        <label for="end_line" class="form-label">Closing Text</label>
                        <input type="text" id="end_line" name="endline" class="form-control" 
                               value="{{ old('endline') }}" placeholder="e.g., Best regards" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>