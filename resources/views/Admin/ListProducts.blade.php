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
                        <td>{{ Str::limit($product->product_description, 30) }}</td>
                        <td><i class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($product->product_price, 2) }}</td>
                        <td>

                            @php
                                $images = json_decode($product->product_image, true);
                            @endphp

                            @if (!empty($images))

                                <img src="{{ asset('uploads/products/' . $images[0]) }}" alt="{{ $product->product_name }}"
                                    width="60" height="60" class="rounded">

                            @endif
                        </td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('product.delete', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this product?')"><i
                                        class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection