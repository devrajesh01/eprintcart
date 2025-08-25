{{-- @extends('Admin.AdminDashboard')

@section('editProduct')
<div class="container mt-4">

    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('list.products') }}" class="btn btn-light btn-sm">
            ← Back
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Edit Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control"
                                value="{{ $product->product_name }}" required>
                        </div>

                        <!-- Product Category -->
                        <div class="mb-3">
                            <label for="product_category" class="form-label">Category</label>
                            <input type="text" name="product_category" id="product_category" class="form-control"
                                value="{{ $product->product_category }}" required>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price</label>
                            <input type="number" name="product_price" id="product_price" class="form-control" step="0.01"
                                value="{{ $product->product_price }}" required>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="product_quantity" class="form-label">Quantity</label>
                            <input type="number" name="product_quantity" id="product_quantity" class="form-control"
                                value="{{ $product->product_quantity }}" required>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="product_description" class="form-label">Description</label>
                            <textarea name="product_description" id="product_description" class="form-control" rows="4">{{ $product->product_description }}</textarea>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*">
                            <!-- Preview -->
                            <img id="preview_image" src="{{ asset('uploads/products/' . $product->product_image) }}" width="100" class="mt-2 border rounded">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Instant Preview Script -->
<script>
    document.getElementById('product_image').addEventListener('change', function (event) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview_image').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection --}}

@extends('Admin.AdminDashboard')

@section('editProduct')
    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('list.products') }}" class="btn btn-light btn-sm">← Back</a>
        </div>

        <div class="card shadow-lg rounded-3">
            <div class="card-header bg-dark text-white">
                <h4>Edit Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Bootstrap Tabs -->
                    <ul class="nav nav-tabs mb-3" id="editTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#basic" role="tab">Basic Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tags" role="tab">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#images" role="tab">Images</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Basic Info Tab -->
                        <div class="tab-pane fade show active" id="basic" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" class="form-control"
                                        value="{{ old('product_name', $product->product_name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Category</label>
                                    <input type="text" name="product_category" class="form-control"
                                        value="{{ old('product_category', $product->product_category) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Price</label>
                                    <input type="number" name="product_price" class="form-control" step="0.01"
                                        value="{{ old('product_price', $product->product_price) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Quantity</label>
                                    <input type="number" name="product_quantity" class="form-control"
                                        value="{{ old('product_quantity', $product->product_quantity) }}" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Description</label>
                                    <textarea name="product_description" class="form-control" rows="4">{{ old('product_description', $product->product_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Tags Tab -->
                        <div class="tab-pane fade" id="tags" role="tabpanel">
                            <div class="mb-3">
                                <label>Product Tags</label>
                                <input type="text" name="product_tags" id="product_tags"
                                    value="{{ $product->product_tags ? implode(',', json_decode($product->product_tags, true)) : '' }}">

                                <small class="text-muted">Type and press Enter to add tags</small>
                            </div>
                        </div>

                        <!-- Images Tab -->
                        <div class="tab-pane fade" id="images" role="tabpanel">
                            <div class="mb-3">
                                <label>Existing Images</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @if ($product->product_image)
                                        @foreach (json_decode($product->product_image, true) as $img)
                                            <div class="position-relative me-2 text-center">
                                                <img src="{{ asset('uploads/products/' . $img) }}" width="100"
                                                    class="border rounded mb-1">
                                                <label><input type="checkbox" name="remove_images[]"
                                                        value="{{ $img }}"> Remove</label>
                                            </div>
                                        @endforeach
                                    @endif
                                    

                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Add New Images</label>
                                <input type="file" name="product_images[]" id="new_images" class="form-control" multiple
                                    accept="image/*">
                                <div id="preview-container" class="d-flex flex-wrap gap-2 mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Tagify -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.8/tagify.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.8/tagify.min.js"></script>

    <script>
        // Initialize Tagify for tags input
        var input = document.querySelector('#product_tags');
        new Tagify(input);

        // Preview for new uploaded images
        document.getElementById('new_images').addEventListener('change', function(event) {
            let preview = document.getElementById('preview-container');
            preview.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 100;
                    img.classList.add('border', 'rounded');
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
