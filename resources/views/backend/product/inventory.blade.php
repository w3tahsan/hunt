@extends('backend.layout.layouts')
@section('content')
@can('inventory')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Inventory List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                @foreach ($inventory as $inv)
                <tr>
                    <td>{{$inv->rel_to_color->color_name}}</td>
                    <td>{{$inv->rel_to_size->size_name}}</td>
                    <td>{{$inv->quantity}}</td>
                    <td>
                        <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h5>Add Inventory for , <strong>{{$product_info->product_name}}</strong></h5>
        </div>
        <div class="card-body">
            <form action="{{route('inventory.store')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product_info->id}}">
                <div class="mb-3">
                    <select name="color_id" class="form-control">
                        <option value="">Select Color</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->id}}">{{$color->color_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <select name="size_id" class="form-control">
                        <option value="">Select Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection
