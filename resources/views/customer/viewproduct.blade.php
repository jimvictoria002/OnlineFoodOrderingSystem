@include('customer-partials._header')
@include('customer-partials._nav')


<div class="form-control" >
    <form action="/{{$product->category}}/{{$product->id}}/{{Auth::user()->id}}" 
    method="POST"  
    class="info-form">
        @csrf
        <div class="img-buy-container" style="width: 100%;">
            <img src="{{ asset('storage/products/'.$product->product_img) }}" style="width: 100%; border-radius: 4px;">  
        </div>
        <div class="product-buy-name">
            <h2 style="font-size: 2rem;">{{$product->product_name}}</h2>
            <h2 style="font-size: 1rem; margin: 1rem 0;">{{$product->product_price}}Php</h2>
        </div>

        <input type="submit" value="Buy" class="update-btn btn" 
        style="width: 100%; 
        padding: .5rem 0; 
        font-size: 1.7rem;
        margin-bottom: 1rem;">
        <a href="/{{$product->category}}" class="delete-btn btn" style="background-color: #ff8906; width: 150px; margin-left: auto;">Back</a>
    </form>
</div>

@include('customer-partials._footer')