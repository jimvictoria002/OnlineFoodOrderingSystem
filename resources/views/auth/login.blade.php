@include('partials._header')

<div class="form-control">
    
    <form action="/check" method="POST" style="width: 60%; margin: auto;">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first()  }}</div>
        @endif
        <div class="product-name-container">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Enter username">
        </div>
        <div class="product-name-container">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter password">
        </div>
        <input type="submit" value="Login" class="bn49">
    </form>
</div>

@include('partials._footer')