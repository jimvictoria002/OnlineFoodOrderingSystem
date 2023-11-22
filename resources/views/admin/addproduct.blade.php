@include('partials._header')
@include('partials._nav')

<div class="form-control">
    
    <form action="/admin/{{$category}}/storeproduct" 
    method="post"
    enctype="multipart/form-data"
    class="info-form">
    
        @csrf
        <div class="adding-updating">
            <p style="font-size: 2rem;">Adding product</p>
        </div>
        <div class="product-name-container">
            @if(session('success'))
                <p>{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first()  }}</div>
            @endif
            <label for="product_name">Product name</label>
            <input type="text" name="product_name" placeholder="Enter product name">
        </div>
        <div class="price-name-container">
            <label for="product_price" >Product price</label>
            <input type="text" name="product_price" placeholder="Enter product price" style="width: 70%;">
        </div>
        <label for="">Product image</label>
        <input type="file" name="product_img">
        <input type="submit" value="Done" class="bn49">
    </form>
</div>

@include('partials._footer')