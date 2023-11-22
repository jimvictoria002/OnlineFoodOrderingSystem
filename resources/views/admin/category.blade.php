@include('partials._header')
@include('partials._nav',['active_category' => $category])

<div class="product-container">
    <div class="tags">
        <p>{{$category}} Best sellers</p>
    </div>
    <div class="products">
        <div class="swiper mySwiper0">
            <div class="swiper-wrapper">
                @foreach($productsYes as $product)
                
                <a class="swiper-slide" href="/admin/{{$category}}/{{$product->id}}">
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
                        <form action="/admin/markbestseller/{{$product->category}}/{{$product->id}}"
                        method="post"
                        class="best-seller-form">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="best-seller-btn">Remove as best seller</button>
                        </form>
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
        <a href="/admin/{{$category}}/addproduct" class="add-product">add <i class="fa-solid fa-plus"></i></a>
    </div>
    <div class="products-wrapper">
        @foreach($productsNot as $product)
        <div class="my-product">
            <div class="product-card-best">
            <a class="product-card" href="/admin/{{$product->category}}/{{$product->id}}">
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
            <form action="/admin/markbestseller/{{$product->category}}/{{$product->id}}" 
            method="post"
            class="best-seller-form">
                @method('PUT')
                @csrf
                <button type="submit" class="best-seller-btn">mark as best seller</button>
            </form>
            </div>
        </div>
        
        @endforeach
    </div>
    
</div>

@include('partials._footer')