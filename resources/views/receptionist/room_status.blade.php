<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('receptionist.css')
    <style type="text/css">
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .status-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 30px;
            background: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .status-header {
            text-align: center;
            margin-bottom: 30px;
            color: #ffffff;
            font-size: 26px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }

        .status-header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #4299e1;
        }

        .status-form-group {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .status-form-group label {
            width: 200px;
            font-weight: 500;
            color: #cbd5e0;
            font-size: 15px;
        }

        .status-form-control {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #2d3748;
            border-radius: 8px;
            font-size: 15px;
            background-color: #2a2a2a;
            color: #f7fafc;
            transition: all 0.3s;
            max-width: 400px;
        }

        .status-form-control:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
            background-color: #1f1f1f;
        }

        select.status-form-control {
            height: 42px;
        }

        textarea.status-form-control {
            min-height: 100px;
        }

        .btn-update {
            padding: 12px 30px;
            background: #4299e1;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: block;
            margin: 30px auto 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-update:hover {
            background: #3182ce;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-left: 200px;
        }

        .checkbox-container input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            accent-color: #4299e1;
        }

        .alert-success {
            background-color: #22543d;
            padding: 15px;
            color: #9ae6b4;
            border: 1px solid #2f855a;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
        }

        .room-info-badge {
            display: inline-block;
            padding: 8px 15px;
            background: #2a4365;
            color: #bee3f8;
            border-radius: 20px;
            font-weight: 500;
            margin: 0 5px 10px 0;
        }

        @media (max-width: 768px) {
            .status-form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .status-form-group label {
                width: 100%;
                margin-bottom: 8px;
            }

            .status-form-control {
                width: 100%;
                max-width: 100%;
            }

            .checkbox-container {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="status-container">
                    <h2 class="status-header">Manage Room Status: {{ $room->room_number }}</h2>
                    
                    <div class="room-info-badges">
                        <span class="room-info-badge">Type: {{ $room->room_type }}</span>
                        <span class="room-info-badge">Price: {{ $room->price_per_night }} DA</span>
                    </div>

                    @if(session('success'))
                        <div class="alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('room.status.update', $room->id) }}">
                        @csrf

                        <div class="status-form-group">
                            <label for="clean_status">Clean Status:</label>
                            <select name="clean_status" id="clean_status" class="status-form-control">
                                <option value="clean" {{ $room->clean_status == 'clean' ? 'selected' : '' }}>Clean</option>
                                <option value="dirty" {{ $room->clean_status == 'dirty' ? 'selected' : '' }}>Dirty</option>
                                <option value="in_progress" {{ $room->clean_status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            </select>
                        </div>

                        <div class="status-form-group">
                            <label for="last_cleaned_by">Cleaned By:</label>
                            <select name="last_cleaned_by" id="last_cleaned_by" class="status-form-control">
                                <option value="">-- Select Employee --</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}" {{ $room->last_cleaned_by == $emp->id ? 'selected' : '' }}>
                                        {{ $emp->first_name }} {{ $emp->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="status-form-group">
                            <label>Maintenance:</label>
                            <div class="checkbox-container">
                                <input type="checkbox" name="needs_maintenance" id="needs_maintenance" value="1" {{ $room->needs_maintenance ? 'checked' : '' }}>
                                <label for="needs_maintenance" style="width: auto;">Mark as needing maintenance</label>
                            </div>
                        </div>

                        <div class="status-form-group">
                            <label for="maintenance_notes">Maintenance Notes:</label>
                            <textarea name="maintenance_notes" id="maintenance_notes" class="status-form-control">{{ $room->maintenance_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn-update">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>
