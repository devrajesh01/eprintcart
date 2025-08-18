@extends('Admin.AdminDashboard')
@section('addproduct')

<div class="container mt-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Add New Product</h4>
        </div>
        <div class="card-body">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}" required>
                </div>

                <!-- Product Category -->
                <div class="mb-3">
                    <label for="product_category" class="form-label">Product Category</label>
                    <select name="product_category" id="product_category" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <option value="Electronics" {{ old('product_category') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="Clothing" {{ old('product_category') == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                        <option value="Books" {{ old('product_category') == 'Books' ? 'selected' : '' }}>Books</option>
                        <option value="Accessories" {{ old('product_category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                    </select>
                </div>

                <!-- Product Description -->
                <div class="mb-3">
                    <label for="product_description" class="form-label">Product Description</label>
                    <textarea name="product_description" id="product_description" rows="4" class="form-control" required>{{ old('product_description') }}</textarea>
                </div>

                <!-- Product Price -->
                <div class="mb-3">
                    <label for="product_price" class="form-label">Product Price ($)</label>
                    <input type="number" name="product_price" id="product_price" class="form-control" step="0.01" value="{{ old('product_price') }}" required>
                </div>

                <!-- Product Quantity -->
                <div class="mb-3">
                    <label for="product_quantity" class="form-label">Product Quantity</label>
                    <input type="number" name="product_quantity" id="product_quantity" class="form-control" min="1" value="{{ old('product_quantity') }}" required>
                </div>

                <!-- Product Image -->
                <div class="mb-3">
                    <label for="product_image" class="form-label">Product Image</label>
                    <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*" required>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
