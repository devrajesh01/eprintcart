@extends('Admin.AdminDashboard')

@section('dashboardcontent')
<div>
    <table class="table table-bordered table-striped text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>Product Name</th>
            <th>Product Category</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Product Image</th>
            <th>Product Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_category ?? 'N/A' }}</td>
                <td>{{ Str::limit($product->product_description, 100) }}</td>
                <td>${{ number_format($product->product_price, 2) }}</td>
                <td>
                    <img src="{{ asset('storage/products/' . $product->product_image) }}" 
                         alt="{{ $product->product_name }}" 
                         width="60" height="60"
                         class="rounded">
                </td>
                <td>{{ $product->product_quantity }}</td>
                <td>
                    {{-- <a href="{{ route('product.page', $product->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('product.delete', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                            Delete
                        </button> --}}
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>



@endsection
