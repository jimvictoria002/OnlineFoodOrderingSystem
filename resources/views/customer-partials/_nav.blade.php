@php
    use App\Models\Category;
    $categories = Category::orderBy('created_at', 'desc')
        ->get();
    $active_category = (isset($active_category)) ? $active_category : '';
@endphp
<nav>
    <h1 id="nav-toggle">
        <i class="fa-solid fa-bars"></i>
    </h1>
    <div class="logo">
        <a href="/home">
            <h1>Food <span>Online</span></h1>
        </a>
    </div>
    <div class="profile" id="profile-toggle">
        <div>
            <p class="name">{{Auth::user()->firstname[0]}}. {{Auth::user()->lastname}}</p>
        </div>
        <div class="user-avatar">
            <i class="fa-regular fa-user"></i>
        </div>
    </div>
    <div class="profile-dropdown" id="profileDropdown">
        <a href="/myorders/ongoing">My orders</a>
        <a href="#">Sales</a>
        <form action="/logout" method="post">
            @csrf
            <input type="submit" value="Logout">
        </form>
    </div>
</nav>

<div class="menu-wrapper" id="menuWrapper">
    <div class="main-category-wrapper">
        <div class="category">
            <p>Category</p>
        </div>
        <div class="menus">
            <div class="menu {{ ($active_category == '') ? 'active' : ''}}">
                <a href="/home">Home</a>
            </div>
            @foreach($categories as $category)
                <div class="menu {{ ($category->category_name == $active_category) ? 'active' : ''}}">
                    <a href="/{{$category->category_name}}">{{$category->category_name}}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>


