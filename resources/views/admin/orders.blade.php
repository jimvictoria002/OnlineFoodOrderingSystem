@include('partials._header')
@include('partials._nav')


<div class="form-control" style="width: 80%; ">
    <div class="tags">
        <p>Orders</p>
        <select name="" onchange="updateLocation(this)" style="padding: 0;">
            <option value="/admin/orders/pending" {{ ($status == 'pending') ? 'selected' : ''}}>pending</option>
            <option value="/admin/orders/processing" {{ ($status == 'processing') ? 'selected' : ''}}>processing</option>
            <option value="/admin/orders/OTW" {{ ($status == 'OTW') ? 'selected' : ''}}>OTW</option>
            <option value="/admin/orders/completed" {{ ($status == 'completed') ? 'selected' : ''}}>Completed</option>
            <option value="/admin/orders/cancelled" {{ ($status == 'cancelled') ? 'selected' : ''}}>Cancelled</option>
        </select>
    </div>
    <div class="orders-container">
        <table>
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Price</th>
                    <th>Firstname</th>
                    <th>Middlename</th>
                    <th>Lastname</th>
                    <th>Order date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{$order->product->product_name}}</td>
                <td>{{$order->product->product_price}}Php</td>
                <td>{{$order->customer->firstname}}</td>
                <td>{{$order->customer->middlename}}</td>
                <td>{{$order->customer->lastname}}</td>
                <td>{{$order->order_date}}</td>
                <td>
                    <select name="" onchange="updateStatus(this)" style="padding: 0;">
                        <option value="/admin/orders/pending/{{$order->id}}" {{ ($status == 'pending') ? 'selected' : ''}}>pending</option>
                        <option value="/admin/orders/processing/{{$order->id}}" {{ ($status == 'processing') ? 'selected' : ''}}>processing</option>
                        <option value="/admin/orders/OTW/{{$order->id}}" {{ ($status == 'OTW') ? 'selected' : ''}}>OTW</option>
                        <option value="/admin/orders/completed/{{$order->id}}" {{ ($status == 'completed') ? 'selected' : ''}}>Completed</option>
                        <option value="/admin/orders/cancelled/{{$order->id}}" {{ ($status == 'cancelled') ? 'selected' : ''}}>Cancelled</option>
                    </select>
                    <form action="" method="POST" id="updateStatus">
                        @csrf
                        @method('PUT')

                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('partials._footer')