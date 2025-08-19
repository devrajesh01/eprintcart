@extends('Admin.AdminDashboard')
@section('editProduct')

    <div class="backbtn">
        <a href="{{ route('list.products') }}" class="btn btn-light btn-sm">
            ← Back
        </a>
    </div>
    <div class="container mt-4">
        <div class="card shadow-lg rounded-3">

            <div class="card-header bg-dark text-white">
                <h4>Edit Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}"
                            required>
                    </div>

                    <!-- Product Category -->
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Category</label>
                        <input type="text" name="product_category" class="form-control"
                            value="{{ $product->product_category }}" required>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Price</label>
                        <input type="number" name="product_price" class="form-control" step="0.01"
                            value="{{ $product->product_price }}" required>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="product_quantity" class="form-label">Quantity</label>
                        <input type="number" name="product_quantity" class="form-control"
                            value="{{ $product->product_quantity }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="product_description" class="form-label">Description</label>
                        <textarea name="product_description" class="form-control"
                            rows="4">{{ $product->product_description }}</textarea>
                    </div>

                    <!-- Image -->
                    {{-- <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="product_image" class="form-control">
                        <img src="{{ asset('uploads/products/' . $product->product_image) }}" width="80" class="mt-2">
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="product_image" class="form-control" id="product_image" accept="image/*">

                        <!-- Preview -->
                        <img id="preview_image" src="{{ asset('uploads/products/' . $product->product_image) }}" width="80"
                            class="mt-2 border rounded">
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Preview selected image instantly
        document.getElementById('product_image').addEventListener('change', function (event) {
            let reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview_image').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endsection