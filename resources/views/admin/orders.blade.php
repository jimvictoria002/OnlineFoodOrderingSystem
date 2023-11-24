@include('partials._header')
@include('partials._nav')


<div class="form-control" style="width: 40%; ">
    <div class="tags">
        <p>Orders</p>
        <select name="" onchange="updateLocation(this)" style="padding: 0;">
            <option value="" selected>--</option>
            <option value="/admin/orders/pending">pending</option>
            <option value="/admin/orders/processing">processing</option>
            <option value="/admin/orders/OTW">OTW</option>
            <option value="/admin/orders/completed">Completed</option>
            <option value="/admin/orders/cancelled">Cancelled</option>
        </select>
    </div>
    <div class="orders-container">
        @foreach($orders as $order)
        
        @endforeach
    </div>
</div>

@include('partials._footer')