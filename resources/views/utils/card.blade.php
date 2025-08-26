<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-2 fw-bold">Featured Products</h2>
        <div class="row g-4">            
            @foreach ($products->take(6) as $product)
                @php                    
                    $images = $product->product_image ? json_decode($product->product_image, true) : [];
                    $tags = $product->product_tags ? json_decode($product->product_tags, true) : [];
                    $firstImage = count($images) > 0 ? $images[0] : null;
                @endphp

                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('product.page', ['id' => $product->id]) }}">
                        <div class="card product-card h-100">
                            <div class="card-img-wrapper">
                                @if ($firstImage)
                                    <img src="{{ asset('uploads/products/' . $firstImage) }}" class="card-img-top"
                                        alt="{{ $product->product_name }}">
                                @else
                                    <img src="{{ asset('uploads/products/default.png') }}" class="card-img-top"
                                        alt="No image">
                                @endif
                            </div>
                            <div class="card-body text-start">
                                <h5 class="card-title fw-bold">{{ $product->product_name }}</h5>
                                <p class="card-text text-muted">{{ $product->product_description }}</p>

                                {{-- Show price --}}
                                <p class="fw-bold text-success mb-2">
                                    <i class="fa-solid fa-indian-rupee-sign"></i> 
                                    {{ number_format($product->product_price, 2) }}
                                </p>

                                {{-- Show tags if available --}}
                                @if (!empty($tags))
                                    <div class="mb-2">
                                        @foreach ($tags as $tag)
                                            <span class="badge bg-secondary me-1">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <a href="{{ route('product.page', ['id' => $product->id]) }}" class="btn btn-theme">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
