@extends('Admin.AdminDashboard')

@section('dashboardcontent')
<div>
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordered_product as $payment)
                @php
                    $productIds = $payment->product_id ?? [];
                    $quantities = $payment->product_quantity ?? [];
                    $images = $payment->product_image ?? [];
                    // Fetch products for this order
                    $products = \App\Models\Product::whereIn('id', $productIds)->get();
                @endphp

                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->user->name ?? 'Guest' }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_category }}</td>
                        <td>{{ $product->product_description }}</td>
                        <td>
                            <i class="fa-solid fa-indian-rupee-sign"></i> 
                            <strong>{{ number_format($product->product_price, 2) }}</strong>
                        </td>
                        <td>
                            @php
                                $image = $images[$index] ?? (is_array($product->product_image) ? ($product->product_image[0] ?? 'default.png') : 'default.png');
                            @endphp
                            <img src="{{ asset('uploads/products/' . $image) }}" alt="product" width="60">
                        </td>
                        <td><strong>{{ $quantities[$index] ?? 1 }}</strong></td>
                        <td>
                            <i class="fa-solid fa-indian-rupee-sign"></i> 
                            <strong>{{ number_format(($product->product_price * ($quantities[$index] ?? 1)), 2) }}</strong>
                        </td>
                        <td>
                            @if($payment->status == 'success')
                                <span class="badge bg-success">Delivered</span>
                            @elseif($payment->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary">View</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
