@extends('backend.layout.layouts')
@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Color List</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Color Name</th>
                    <th>Color Code</th>
                    <th>Action</th>
                </tr>
                @foreach ($colors as $color)                
                <tr>
                    <td>{{$color->color_name}}</td>
                    <td><span class="badge" style="background-color: {{$color->color_code}};">{{$color->color_name}}</span></td>
                    <td>
                        <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Size List</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($categories as $category)                    
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                {{$category->category_name}}
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Size Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse (App\Models\Size::where('category_id', $category->id)->get() as $size)
                                    <tr>
                                        <td>{{$size->size_name}}</td>
                                        <td>
                                            <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="2">No Size Found</td>
                                    </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add Color</h3>
        </div>
        <div class="card-body">
            <form action="{{route('color.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="">Color name</label>
                    <input type="text" name="color_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Color Code</label>
                    <input type="text" name="color_code" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Color</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Add Size</h3>
        </div>
        <div class="card-body">
            <form action="{{route('size.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)                            
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Size name</label>
                    <input type="text" name="size_name" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Size</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection