@extends('layout.masterlayout')

@section('content')
    <section class="profile-dashboard py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Welcome {{ Auth::user()->name ?? 'John Doe' }}</h2>

            <!-- User Info Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Name:</strong></div>
                        <div class="col-md-6">{{ Auth::user()->name ?? 'John Doe' }}</div>
                    </div>
                    {{-- <div class="row mb-2">
                        <div class="col-md-6"><strong>Username:</strong></div>
                        <div class="col-md-6">{{ Auth::user()->username ?? 'johndoe' }}</div>
                    </div> --}}
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Email:</strong></div>
                        <div class="col-md-6">{{ Auth::user()->email ?? 'john@example.com' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Phone:</strong></div>
                        <div class="col-md-6">{{ Auth::user()->phone ?? '+1234567890' }}</div>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">My Orders</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0 text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Order Quantity</th>
                                <th>Product Image</th>
                                <th>Date</th>
                                {{-- <th>Status</th> --}}
                                <th>Amount</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_data as $data)
                                @php
                                    // Normalize product_id
                                    $productIds = is_string($data->product_quantity)
                                        ? json_decode($data->product_quantity, true)
                                        : $data->product_quantity;

                                    if (!is_array($productIds)) {
                                        $productIds = [$data->product_id]; // fallback
                                    }

                                    // Normalize product_image
                                    $images = is_string($data->product_image)
                                        ? json_decode($data->product_image, true)
                                        : $data->product_image;

                                    if (!is_array($images)) {
                                        $images = [$data->product_image]; // fallback
                                    }

                                    $firstImg = $images[0] ?? 'default.png';
                                @endphp

                                <tr>
                                    <!-- Order ID(s) -->
                                    <td>{{ implode(', ', $productIds) }}</td>

                                    <!-- Product Image -->
                                    <td>
                                        <img src="{{ asset('uploads/products/' . $firstImg) }}" alt="Product Image" width="60"
                                            height="60" style="object-fit:cover; border-radius:6px;">
                                    </td>

                                    <!-- Order Date -->
                                    <td>{{ $data->created_at->format('Y-m-d') }}</td>

                                    <!-- Status -->
                                    {{-- <td>
                                        <span class="badge bg-success">{{ $data->status ?? 'Delivered' }}</span>
                                    </td> --}}

                                    <!-- Amount -->
                                    <td>₹{{ number_format($data->amount, 2) }}</td>

                                    <!-- Action -->
                                    {{-- <td>
                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection