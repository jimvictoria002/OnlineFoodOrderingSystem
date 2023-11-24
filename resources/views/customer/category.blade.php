@include('customer-partials._header')
@include('customer-partials._nav', ['active_category' => $category])
<div class="product-container">
    <div class="tags">
        <p>{{$category}} Best sellers</p>
    </div>
    <div class="products">
        <div class="swiper mySwiper0">
            <div class="swiper-wrapper">
                @foreach($productsYes as $product)
                
                <a class="swiper-slide" href="/{{$category}}/{{$product->id}}">
                    <div class="product-card-best">
                        <div class="product-img">
                            <img src="{{ asset('storage/products/'.$product->product_img) }}" alt="">  
                        </div>
                        <div class="product-description">
                            <p class="product-name-card">
                                {{$product->product_name}}
                            </p>
                            <p class="product-price-card">
                                {{$product->product_price}}Php
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="swiper-button-next swiper-button-next0 nav-btn"></div>
        <div class="swiper-button-prev swiper-button-prev0 nav-btn"></div>
        <div class="swiper-pagination swiper-pagination0"></div>
    </div>
</div>


<div class="category-main">
    <div class="tags">
        <p>{{$category}}</p>
    </div>
    <div class="products-wrapper">
        @foreach($productsNot as $product)
        <div class="my-product">
            <div class="product-card-best">
            <a class="product-card" href="/{{$product->category}}/{{$product->id}}">
                <div class="img-product-card">
                    <img src="{{ asset('storage/products/'.$product->product_img) }}" alt="">
                </div>
                <div class="product-description">
                    <p class="product-name-card">
                        {{$product->product_name}}
                    </p>
                    <p class="product-price-card">
                        {{$product->product_price}}Php
                    </p>
                    
                </div>
            </a>
            </div>
        </div>
        
        @endforeach
    </div>
    
</div>
@include('customer-partials._footer')