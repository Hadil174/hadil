<!DOCTYPE html>
<html>
<head>
    @include('receptionist.css')
    <style type="text/css">
        .room-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            font-size: 0.9em;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .room-table thead tr {
            background-color: #4a6fa5;
            color: white;
            text-align: center;
            font-weight: 500;
        }
        
        .room-table th,
        .room-table td {
            padding: 8px 10px;
            text-align: center;
            border-bottom: 1px solid #e0e4e8;
        }
        
        .room-table tbody tr {
            transition: all 0.2s;
        }
        
        .room-table tbody tr:nth-of-type(even) {
            background-color: #f8fafc;
        }
        
        .room-table tbody tr:last-of-type {
            border-bottom: 2px solid #4a6fa5;
        }
        
        .room-table tbody tr:hover {
            background-color: #f0f5ff;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: 500;
            min-width: 80px;
        }
        
        .status-available {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }
        
        .status-occupied {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        
        .status-maintenance {
            background-color: #fef9c3;
            color: #a16207;
            border: 1px solid #fef08a;
        }
        
        .status-housekeeping {
            background-color: #ecfccb;
            color: #4d7c0f;
            border: 1px solid #d9f99d;
        }
        
        .clean-status {
            font-weight: 500;
        }
        
        .clean-clean {
            color: #16a34a;
        }
        
        .clean-dirty {
            color: #dc2626;
        }
        
        .clean-in_progress {
            color: #d97706;
        }
        
        .btn-sm {
            padding: 4px 10px;
            font-size: 0.8em;
            margin: 2px;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .btn-info {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        
        .btn-info:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        
        .btn-success {
            background-color: #10b981;
            border-color: #10b981;
        }
        
        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
        }
        
        .btn-secondary {
            background-color: #94a3b8;
            border-color: #94a3b8;
        }
        
        .action-cell {
            white-space: nowrap;
        }
        
        .compact-view {
            max-width: 98%;
            margin: 0 auto;
            padding: 15px 10px;
        }
        
        h2 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #1e293b;
            font-weight: 600;
        }
        
        .maintenance-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.8em;
        }
        
        .needs-maintenance {
            background-color: #ffedd5;
            color: #9a3412;
        }
        
        .no-maintenance {
            background-color: #f0fdf4;
            color: #166534;
        }
    </style>
</head>

<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="page-header compact-view">
            <div class="container-fluid">
               

                <table class="room-table">
                    <thead>
                        <tr>
                            <th>Room </th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Manage</th>
                            <th>Status</th>
                            <th>Clean</th>
                            <th>Last Cleaned</th>
                            <th>Maint.</th>
                            <th>Last Maint.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $room)
                        <tr>
                            <td><strong>{{ $room->room_number }}</strong></td>
                            <td>{{ Str::limit($room->room_title, 15) }}</td>
                            <td>{{ Str::limit($room->room_type, 10) }}</td>
                            <td>{{ $room->price_per_night }} DA</td>
                            <td>
                                <a href="{{ route('room.status', $room->id) }}" class="btn btn-info btn-sm">Manage</a>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $room->status }}">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="clean-status clean-{{ str_replace(' ', '_', $room->clean_status) }}">
                                    {{ ucfirst($room->clean_status) }}
                                </span>
                            </td>
                            <td>{{ $room->last_cleaned_at ? $room->last_cleaned_at->format('M d') : 'N/A' }}</td>
                            <td>
                                <span class="maintenance-badge {{ $room->needs_maintenance ? 'needs-maintenance' : 'no-maintenance' }}">
                                    {{ $room->needs_maintenance ? 'Needed' : 'OK' }}
                                </span>
                            </td>
                            <td>{{ $room->last_maintenance_date ? $room->last_maintenance_date->format('M d') : 'N/A' }}</td>
                            <td class="action-cell">
                                @if($room->status === 'available')
                                    <a href="{{ url('book_room', $room->id) }}" class="btn btn-success btn-sm">Book</a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>N/A</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>