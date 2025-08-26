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
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Username:</strong></div>
                    <div class="col-md-6">{{ Auth::user()->username ?? 'johndoe' }}</div>
                </div>
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
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Static Example Data -->
                        <tr>
                            <td>#1001</td>
                            <td>Mug Design A</td>
                            <td>2025-08-20</td>
                            <td><span class="badge bg-success">Delivered</span></td>
                            <td>$25</td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>Custom T-Shirt</td>
                            <td>2025-08-22</td>
                            <td><span class="badge bg-warning text-dark">Processing</span></td>
                            <td>$40</td>
                        </tr>
                        <tr>
                            <td>#1003</td>
                            <td>Saree Design B</td>
                            <td>2025-08-25</td>
                            <td><span class="badge bg-info text-dark">Shipped</span></td>
                            <td>$55</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
