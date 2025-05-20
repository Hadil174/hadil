@if(session('success'))
  <div style="color: green;">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div style="color: red;">{{ session('error') }}</div>
@endif

<form action="{{ route('receptionist.attendance.checkin') }}" method="POST">
    @csrf
    <button type="submit">Check In</button>
</form>

<form action="{{ route('receptionist.attendance.checkout') }}" method="POST" style="margin-top:10px;">
    @csrf
    <button type="submit">Check Out</button>
</form>
