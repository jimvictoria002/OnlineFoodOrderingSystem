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
        <a href="/admin/home">
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
        <a href="#">Orders</a>
        <a href="#">Sales</a>
        <form action="/admin/logout" method="post">
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
                <a href="/admin/home">Home</a>
            </div>
            @foreach($categories as $category)
                <div class="menu {{ ($category->category_name == $active_category) ? 'active' : ''}}">
                    <a href="/admin/{{$category->category_name}}">{{$category->category_name}}</a>
                </div>
            @endforeach
        </div>
        <a class="add-product" id="category-toggle-open">add <i class="fa-solid fa-plus"></i></a>
        <a class="add-product" id="deleteCategory-toggle-open" style="margin-top: 1rem; background-color:cyan; color: black;"
        >Edit <i class="fa-solid fa-minus"></i></a>
    </div>
</div>

<div class="add-category" id="addCategory">
    <form action="/admin/storecategory" method="post" class="add-category-form">
        @csrf
        <span><i class="fa-solid fa-x" id="category-toggle-close"></i></span>
        <label for="">Create food category</label>
        <input type="text" name="category" placeholder="Enter food category">
        <input type="submit" value="Done" class="add-product">
    </form>
</div>


<div class="add-category" id="deleteCategory">
    <div class="delete-category-container">
        <div class="tags" style="margin-bottom: 1rem">
            <p>Update category</p>
        </div>
        <span>
            <i class="fa-solid fa-x" id="delete-category-toggle-close"></i>
        </span>
        @foreach($categories as $category)
            <div class="delete-container">
                <form action="/admin/{{$category->id}}/update" method="post" class="upt-category-form">
                    @method('put')
                    @csrf
                    <input type="text" name="category"
                    placeholder="Enter food category"
                    class="category-upt-input"
                    value="{{$category->category_name}}">
                    <input type="submit" value="Update" class="category-upt-btn">
                </form>
                <form action="/admin/{{$category->id}}/delete" method="post" class="delete-form">
                    @method('delete')
                    @csrf
                    <input type="submit" value="Delete" class="delete-category-btn">
                </form>
            </div>
        @endforeach
    </div>
</div>



