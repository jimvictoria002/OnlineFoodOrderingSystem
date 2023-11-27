@include('customer-partials._header')
@include('customer-partials._nav')


<div class="form-control" style="width: 40%; ">
    <div class="tags">
        <p>My orders</p>
        <select name="" onchange="updateLocation(this)" style="padding: 0;">
            <option value="" selected>--</option>
            <option value="/myorders/ongoing">Ongoing</option>
            <option value="/myorders/completed">Completed</option>
            <option value="/myorders/cancelled">Cancelled</option>
        </select>
    </div>
    <div class="orders-container">
        @foreach($orders as $order)
        <div class="order-card" id="{{$order->status}}" >
            <div class="order-img">
                <img src="{{ asset('storage/products/'.$order->product_img) }}" style="width: 100%; border-radius: 4px;">  
            </div>
            <div class="status-container {{$order->status}}">
                <p style="text-transform: uppercase;">{{$order->status}}</p>
            </div>
            <div class="order-attributes">
                <p class="order-name">{{$order->product_name}}</p>
                <p class="order-price">{{$order->product_price}}Php</p>
                <form action="{{ route('customer.cancelorder', ['order_id' => $order->order_id]) }}" method="post" style="width: 90%; flex: 1; display: flex; align-items: end;">

                    @method('put')
                    @csrf
                    @if($order->status != 'pending')
                    <input type="submit" value="Cancel" class="delete-btn" style="width: 100%;
                    background-color: rgb(120, 47, 42);
                    color: darkgrey;
                    cursor: not-allowed;" disabled>
                    @else
                    <input type="submit" value="Cancel" class="delete-btn">
                    @endif
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('customer-partials._footer')