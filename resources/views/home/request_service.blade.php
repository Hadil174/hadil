<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
    <style>
        .service-request-container {
            background-color: #f5f5f0;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #d4af37;
        }
        
        .service-request-header {
            color: #8b6b3d;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        
        .form-control {
            background-color: #fffdf8;
            border: 1px solid #d4af37;
            color: #5a4a3a;
        }
        
        .form-control:focus {
            border-color: #b8860b;
            box-shadow: 0 0 0 0.2rem rgba(184, 134, 11, 0.25);
        }
        
        .btn-primary {
            background-color: #d4af37;
            border-color: #b8860b;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #b8860b;
            border-color: #8b6b3d;
        }
        
        .price-display {
            background-color: #f8f4e6;
            font-weight: bold;
            color: #8b6b3d;
        }
        
        .alert-success {
            background-color: #f0e6cc;
            border-color: #d4af37;
            color: #5a4a3a;
        }

        .alert-danger {
            background-color: #f8e1e1;
            border-color: #e6a8a8;
            color: #5a3a3a;
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

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guest.services.store') }}" method="POST">
            @csrf
           
            <input type="hidden" name="price" id="price_value">
        
            <div class="form-group mb-4">
                <label for="service_name">Select Service *</label>
                <select name="service_name" id="service_name" class="form-control" required onchange="updatePrice()">
                    <option value="">-- Choose a Service --</option>
                    @foreach ($services as $service)
                        <option value="{{ $service['name'] }}" data-price="{{ $service['price'] }}"
                            @if(old('service_name') == $service['name']) selected @endif>
                            {{ $service['name'] }} - {{ $service['price'] }} DA
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
                <textarea name="notes" id="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
            </div>
        
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>
        </form>
    </div>
</div>

<script>
// Update price display on page load and change
function updatePrice() {
    const select = document.getElementById('service_name');
    const selectedOption = select.options[select.selectedIndex];
    const price = selectedOption.getAttribute('data-price') || '';
    
    document.getElementById('price_display').value = price ? price + ' DA' : '';
    document.getElementById('price_value').value = price; // Set hidden field for form submission
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePrice();
});
</script>

@include('home.footer')
</body>
</html>