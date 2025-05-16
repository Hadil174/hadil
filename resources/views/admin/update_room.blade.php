<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('admin.css')

    <style>
       body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #121212;
    color: #e0e0e0;
}

.form-wrapper {
    max-width: 800px;
    margin: 60px auto;
    background: #3d3d3d;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
}

h1 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 30px;
    color: #ffffff;
    font-weight: bold;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #cccccc;
}

input[type="text"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 20px;
    border-radius: 6px;
    border: 1px solid #444;
    background-color: #2c2c2c;
    color: #e0e0e0;
    transition: border 0.3s ease;
    font-size: 0.95rem;
}

input[type="text"]:focus,
input[type="number"]:focus,
select:focus,
textarea:focus {
    border-color: #64b5f6;
    outline: none;
}

textarea {
    resize: vertical;
}

button {
    background-color: #787a7c;
    color: white;
    padding: 12px 22px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    font-size: 1rem;
    width: 100%;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #51565c;
}

.alert-success {
    background-color: #2e7d32;
    color: #ffffff;
    border: 1px solid #1b5e20;
    padding: 12px 20px;
    border-radius: 6px;
    margin-bottom: 30px;
    font-weight: 500;
    text-align: center;
}


    </style>
</head>
<body>

    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container">

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-wrapper">
                <h1>Update Room</h1>

                <form action="{{ route('edit_room', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="room_number">Room Number</label>
                        <input type="text" id="room_number" name="room_number" value="{{ old('room_number', $data->room_number) }}" required>
                    </div>

                    <div>
                        <label for="room_title">Room Title</label>
                        <input type="text" id="room_title" name="room_title" value="{{ old('room_title', $data->room_title) }}" required>
                    </div>

                    <div>
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required>{{ $data->description }}</textarea>
                    </div>

                    <div>
                        <label for="price_per_night">Price per Night (DA)</label>
                        <input type="number" id="price_per_night" name="price_per_night" step="0.01" value="{{ $data->price_per_night }}" required>
                    </div>

                    <div>
                        <label for="room_type">Room Type</label>
                        <select id="room_type" name="room_type" required>
                            <option selected value="{{ $data->room_type }}">{{ ucfirst($data->room_type) }}</option>
                            <option value="single">Single</option>
                            <option value="double">Double</option>
                            <option value="suite">Suite</option>
                        </select>
                    </div>

                    <div>
                        <label for="status">Room Status</label>
                        <select id="status" name="status" required>
                            <option selected value="{{ $data->status }}">{{ ucfirst($data->status) }}</option>
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="out_of_order">Out of Order</option>
                        </select>
                    </div>

                    <div>
                        <label for="image">Room Image</label>
                        <input type="file" id="image" name="images" accept="image/*">
                    </div>

                    <div>
                        <button type="submit">Update Room</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @include('admin.footer')

</body>
</html>
