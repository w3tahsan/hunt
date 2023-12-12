@extends('backend.layout.layouts')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>Product List</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive">
                <tr>
                    <th>Preview</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>After Discount</th>
                    <th>SKU</th>
                    <th>New Year</th>
                    <th>Upcoming</th>
                    <th>Banner</th>
                    <th>Today</th>
                    <th>Trendy</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($products as $product)

                <tr>
                    <td>
                        <img width="100" src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="">
                    </td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount}}</td>
                    <td>{{$product->after_discount}}</td>
                    <td>{{$product->sku}}</td>
                    <td class="toggle-btn text-center">
                        <div class="check-box">
                            <input type="checkbox" {{ $product->new == 1?'checked':'' }} class="new" data-id="{{ $product->id }}" value="{{ $product->new }}">
                        </div>
                    </td>
                    <td class="toggle-btn text-center">
                        <div class="check-box">
                            <input type="checkbox">
                        </div>
                    </td>
                    <td class="toggle-btn">
                        <div class="check-box">
                            <input type="checkbox">
                        </div>
                    </td>
                    <td class="toggle-btn ml-2">
                        <div class="check-box">
                            <input type="checkbox">
                        </div>
                    </td>
                    <td class="toggle-btn">
                        <div class="check-box">
                            <input type="checkbox">
                        </div>
                    </td>
                    <td class="toggle-btn">
                        <div class="check-box">
                            <input type="checkbox">
                        </div>
                    </td>
                    <td style="width:100px">
                        <a href="{{route('inventory', $product->id)}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-archive"></i></a>
                        @can('product_delete')
                        <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                        @endcan
                    </td>

                </tr>
                @endforeach
            </table>
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $('.new').change(function(){
        if($(this).val() != 1){
            $(this).attr('value', 1);
        }
        else{
            $(this).attr('value', 0);
        }
        var status = $(this).val();
        var product_id = $(this).attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/offer/status/change',
            data:{'status': status, 'product_id':product_id},
            success:function(data){
            }
        });

    })
</script>
@endsection
