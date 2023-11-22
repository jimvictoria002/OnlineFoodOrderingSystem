@include('partials._header')
@include('partials._nav')

<div class="form-control" >
    <form action="/admin/{{$product->category}}/{{$product->id}}" 
    method="POST" 
    enctype="multipart/form-data" 
    class="info-form">
        @method('PUT')
        @csrf
        <div class="adding-updating">
            <p style="font-size: 2rem;">Update product</p>
        </div>
        <div class="product-name-container">
            @if(session('success'))
                <p>{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first()  }}</div>
            @endif
            <label for="product_name">Product name</label>
            <input type="text" name="product_name" placeholder="Enter product name" value="{{$product->product_name}}">
        </div>
        <div class="price-name-container">
            <label for="product_price" >Product price</label>
            <input type="text" name="product_price" placeholder="Enter product price"  value="{{$product->product_price}}">
        </div>
        <label for="">Product image</label>
        <input type="file" name="product_img">
        <input type="submit" value="Update" class="update-btn btn" style="width:100%;">
    </form>
    <form action="/admin/{{$product->category}}/{{$product->id}}" method="post" class="delete-form">
        @method('delete')
        @csrf
        <input type="submit" value="Delete" class="delete-btn btn">
        <a href="/admin/{{$product->category}}" class="delete-btn btn" style="background-color: #ff8906;">Back</a>
    </form>
    
</div>



@include('partials._footer')