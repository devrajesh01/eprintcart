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
                        // Decode JSON to arrays
                        $productIds = is_string($payment->product_id) ? json_decode($payment->product_id, true) : ($payment->product_id ?? []);
                        $quantities = is_string($payment->product_quantity) ? json_decode($payment->product_quantity, true) : ($payment->product_quantity ?? []);
                        $images = is_string($payment->product_image) ? json_decode($payment->product_image, true) : ($payment->product_image ?? []);

                        // Fetch products for this order
                        $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
                    @endphp

                    @foreach ($productIds as $index => $productId)
                        @php
                            $product = $products[$productId] ?? null;
                        @endphp
                        @if($product)
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
                                        $image = $images[$index] ?? 'default.png';
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
                        @endif
                    @endforeach
                @endforeach

            </tbody>
        </table>
    </div>
@endsection