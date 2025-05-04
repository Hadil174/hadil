<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
    <style>
        .service-request-container {
            background-color: #f5f5f0; /* Light beige background */
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #d4af37; /* Gold accent border */
        }
        
        .service-request-header {
            color: #8b6b3d; /* Dark golden brown */
            border-bottom: 2px solid #d4af37;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        
        .form-control {
            background-color: #fffdf8; /* Off-white with beige tint */
            border: 1px solid #d4af37;
            color: #5a4a3a; /* Dark brown text */
        }
        
        .form-control:focus {
            border-color: #b8860b; /* Darker gold */
            box-shadow: 0 0 0 0.2rem rgba(184, 134, 11, 0.25);
        }
        
        .btn-primary {
            background-color: #d4af37; /* Gold */
            border-color: #b8860b;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #b8860b; /* Darker gold */
            border-color: #8b6b3d;
        }
        
        .price-display {
            background-color: #f8f4e6; /* Light golden beige */
            font-weight: bold;
            color: #8b6b3d;
        }
        
        .alert-success {
            background-color: #f0e6cc; /* Light gold */
            border-color: #d4af37;
            color: #5a4a3a;
        }
        
        label {
            color: #8b6b3d;
            font-weight: 500;
        }
    </style>
</head>
<body>
@include('home.header')

<div class="container mt-5 mb-5">
    <div class="service-request-container">
        <h2 class="service-request-header">Request Additional Service</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('guest.services.store') }}" method="POST">
            @csrf

            <div class="form-group mb-4">
                <label for="service_name">Select Service</label>
                <select name="service_name" id="service_name" class="form-control" onchange="updatePrice()">
                    <option value="">-- Choose a Service --</option>
                    @foreach ($services as $service)
                        <option value="{{ $service['name'] }}" data-price="{{ $service['price'] }}">
                            {{ $service['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label>Price:</label>
                <input type="text" id="price_display" class="form-control price-display" disabled>
            </div>

            <div class="form-group mb-4">
                <label for="notes">Additional Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="4"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>
        </form>
    </div>
</div>

<script>
function updatePrice() {
    const select = document.getElementById('service_name');
    const selectedOption = select.options[select.selectedIndex];
    const price = selectedOption.getAttribute('data-price');
    document.getElementById('price_display').value = price ? price + ' DA' : '';
}
</script>

@include('home.footer')
</body>
</html>