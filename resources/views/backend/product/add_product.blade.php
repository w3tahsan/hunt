@extends('backend.layout.layouts')

@section('content')
@can('product_add')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>Add New Product</h3>
        </div>
        <div class="card-body">
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <select name="category_id" class="form-control category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <select name="subcategory_id" class="form-control subcategory">
                                <option value="">Select Sub Category</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Product Price</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Discount</label>
                            <input type="number" name="discount" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        {{-- <div class="mb-3">
                            <label for="" class="form-label">Tags</label>
                            <input type="text" name="tags" id="input-tags"/>
                        </div> --}}
                        <div class="mb-3">
                            <label for="" class="form-label">Tags</label>
                           <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Short Description</label>
                            <input type="text" name="short_desp" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Long Description</label>
                            <textarea name="long_desp" id="summernote" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Additional Information</label>
                            <textarea name="additional_info" id="summernote2" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Preview Image</label>
                            <input type="file" name="preview" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="" class="form-label">thumnbails Image</label>
                            <input type="file" name="thumbnail[]" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="col-lg-4 m-auto">
                        <div class="mb-3 mt-5">
                            <button type="submit" class="btn btn-primary w-100">Add Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection
@section('footer_script')
<script>
    $(document).ready(function() {
        $('.category').select2();
        $('.subcategory').select2();
    });
</script>
<script>
    $('.category').change(function(){
        var category_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getSubcategory',
            data:{'category_id': category_id},
            success:function(data){
                $('.subcategory').html(data);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script>
    $(document).ready(function() {
        $('#summernote2').summernote();
    });
</script>
<script>
    $('.dropify').dropify();
</script>
{{-- <script>
    $("#input-tags").selectize({
        delimiter: ",",
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input,
            };
        },
    });
</script> --}}

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


<script>
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('success') }}");
    @endif
</script>


@endsection
