@include('customer-partials._header')
@include('customer-partials._nav')

<div class="product-container">
    <div class="tags">
        <p>Best sellers</p>
    </div>
    <div class="products">
        <div class="swiper mySwiper0">
            <div class="swiper-wrapper">
                @foreach($productsYes as $product)
                
                <a class="swiper-slide" href="/admin/{{$product->category}}/{{$product->id}}">
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

@php
use App\Models\Product;
$i = 0;
@endphp
@foreach($categories as $category)
@php
$i++;
@endphp
<div class="product-container">
    <div class="tags">
        <p>{{$category->category_name}}</p>
    </div>
    <div class="products">
        <div class="swiper mySwiper{{$i}}">
            <div class="swiper-wrapper">
            @php
                $products = Product::where('category', $category->category_name)->get();
            @endphp

                @foreach($products as $product)
                @if($product->bestseller != 'yes')
                <a class="swiper-slide" href="/admin/{{$category->category_name}}/{{$product->id}}">
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
                            <button type="submit" class="best-seller-btn">Mark as best seller</button>
                        </form>
                    </div>
                </a>
                @endif
                @endforeach
            </div>
        </div>
        <div class="swiper-button-next swiper-button-next{{$i}} nav-btn"></div>
        <div class="swiper-button-prev swiper-button-prev{{$i}} nav-btn"></div>
        <div class="swiper-pagination swiper-pagination{{$i}}"></div>
    </div>
</div>
@endforeach

@include('customer-partials._footer')