@extends('backend.layout.layouts')
@section('content')
@can('order_access')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>Order List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->total}}</td>
                    <td>{{ $order->created_at->format('d-M-Y')}}</td>
                    <td>
                        @if ($order->status == 0)
                            <span class="badge badge-secondary">Placed</span>
                        @elseif ($order->status == 1)
                         <span class="badge badge-info">Processing</span>
                        @elseif ($order->status == 2)
                         <span class="badge badge-primary">Shipped</span>
                        @elseif ($order->status == 3)
                         <span class="badge badge-warning">Ready To Deliver</span>
                        @elseif ($order->status == 4)
                         <span class="badge badge-success">Delivered</span>
                        @else
                            <span class="badge badge-danger">Cancel</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('order.status.update', $order->id) }}" method="POST">
                            @csrf
                            <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Change Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button name="status" value="0" class="dropdown-item {{ $order->status == 0?'active':'' }}" type="submit">Placed</button>
                                <button name="status" value="1" class="dropdown-item {{ $order->status == 1?'active':'' }}" type="submit">Processing</button>
                                <button name="status" value="2" class="dropdown-item {{ $order->status == 2?'active':'' }}" type="submit">Shipped</button>
                                <button name="status" value="3" class="dropdown-item {{ $order->status == 3?'active':'' }}" type="submit">Ready To Deliver</button>
                                <button name="status" value="4" class="dropdown-item {{ $order->status == 4?'active':'' }}" type="submit">Delivered</button>
                                <button name="status" value="5" class="dropdown-item {{ $order->status == 5?'active':'' }}" type="submit">Cancel</button>
                            </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endcan
@endsection
