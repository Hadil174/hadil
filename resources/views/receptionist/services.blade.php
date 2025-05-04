<!-- resources/views/receptionist/services.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Manage Additional Services</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Request New Service Form -->
        <div class="mb-4">
            <h4>Request New Service</h4>
            <form method="POST" action="{{ route('receptionist.services.store') }}">
                @csrf
                <div class="form-group">
                    <label for="guest_id">Guest</label>
                    <select name="guest_id" id="guest_id" class="form-control" required>
                        <option value="">Select a guest</option>
                        @foreach ($guests as $guest)
                            <option value="{{ $guest->id }}">{{ $guest->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="service_name">Service Name</label>
                    <input type="text" name="service_name" id="service_name" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="notes">Additional Notes</label>
                    <textarea name="notes" id="notes" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Request Service</button>
            </form>
        </div>

        <!-- List of Requested Services -->
        <h4 class="mb-4">Requested Additional Services</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Guest Name</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->guest->name }}</td>
                        <td>{{ $service->service_name }}</td>
                        <td>${{ number_format($service->price, 2) }}</td>
                        <td>
                            <!-- Trigger modal to view details -->
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#serviceModal{{ $service->id }}">View Details</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
