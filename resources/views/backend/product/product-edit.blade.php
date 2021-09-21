@extends('backend.admin-master')
@section('ecom_active')
    active
@endsection
@section('product_active')
    active
@endsection
@section('content')
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Product Edit</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('product.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-12">
                                    {{-- Product Name --}}
                                    <div class="form-group">
                                        <h5>Product Name<span class="text-danger">*</span></h5>
                                        <input type="text" id="product_name" name="product_name" class="form-control"
                                            value="{{ $products->product_name }}">
                                        @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Product Slug --}}
                                    <div class="form-group">
                                        <h5>Product Slug<span class="text-danger">*</span></h5>
                                        <input type="text" id="product_slug" name="product_slug" class="form-control"
                                            value="{{ $products->product_slug }}">
                                        @error('product_slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Product Category --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Select Category <span class="text-danger">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="category_id"
                                            id="category_id">
                                            <option selected="selected" disabled>Select Category One</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($products->category_id == $category->id ) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Product Sub Category --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Select Subcategory <span class="text-danger">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="subcategory_id"
                                            id="subcategory_id">
                                                <option value="">select subcategory</option>
                                            @foreach ($subcategories as $item )
                                                <option value="{{ $item->id }}" @if ($item->id == $products->subcategory_id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Product Sub Sub Category --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Select Sub subcategory Name</h5>
                                        <select class="form-control select2" style="width: 100%;" name="subsubcategory_id"
                                            id="subsubcat_id">
                                                <option value="">Selete Sub Child</option>
                                            @foreach ($subchild as $item )
                                                <option value="{{ $item->id }}" @if ($item->id == $products->subsubcategory_id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subsubcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Product Brand --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Select Brand</label>
                                        <select class="form-control select2" style="width: 100%;" name="brand_id"
                                            id="brand_id">
                                            <option selected="selected" disabled>Select Brand One</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" @if ($brand->id == $products->brand_id ) selected @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group">
                                        <h5>Product Short Summary<span class="text-danger">*</span></h5>
                                        <textarea class="form-control" name="short_details" id="" cols="30"
                                            rows="5">{{ $products->short_details }}</textarea>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        @foreach ( $tags as $tag )
                                            <h5>Product Tag</h5>
                                            <input type="text" name="ptag[]" value="{{ $tag->tag_name }}" class="form-control"><br>
                                            <input type="hidden" name="ptagid[]" value="{{ $tag->id }}">
                                         @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Code<span class="text-danger">*</span></h5>
                                        <input type="text" name="product_code" id="product_code" class="form-control" value="{{ $products->product_code }}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Quantity<span class="text-danger">*</span></h5>
                                        <input type="text" name="product_qty" id="product_qty" class="form-control" value="{{ $products->product_qty }}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                        <input type="text" name="selling_price" id="selling_price" class="form-control" value="{{ $products->selling_price }}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Discount Price</h5>
                                        <input type="text" name="descount_price" id="descount_price" class="form-control" value="{{ $products->descount_price }}">
                                    </div>
                                </div>
                            </div>

                             {{-- Product Attribute Add --}}
                             <div id="dynamic-field-1" class="form-group dynamic-field">
                                 @foreach ( $productAttributes as $pattritem )
                                    <input type="hidden" name="pAttributeId[]" value="{{ $pattritem->id }}">
                                    <div class="row">
                                        {{-- Product Attribute Name --}}
                                        <div class="col-6">
                                            <label for="field" class="font-weight-bold">Attribute Name</label>
                                            <select name="attribute_id[]" id="attribute_id" class="form-control @error('attribute_id') is-invalid @enderror">
                                                <option value="" disabled selected>Select Attribute</option>
                                                @foreach ($attributesetnames as $item)
                                                    <option value="{{ $item->id }}" @if ( $item->id == $pattritem->attributeset_id ) selected @endif>{{ ucwords($item->attribute_name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('attribute_id')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Product Size --}}
                                        <div class="col-6">
                                            <label for="value" class="font-weight-bold">Attribute Value</label>
                                            <select class="form-control" name="value[]" id="value">
                                                <option value="" disabled selected>Select Value</option>
                                                @foreach ($attributeValue as $item )
                                                <option value="{{ $item->value }}" @if ( $item->value == $pattritem->value ) selected @endif>{{ $item->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                 @endforeach
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>Product Thumbnail<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="image" type="file" name="thmbnail" class="form-control">
                                            @error('thumbnail')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <div id="image_preview">
                                             <img id="showImg" src="{{ asset($products->thmbnail) }}" alt="" style="width: 100px">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Product Details<span class="text-danger">*</span></h5>
                                        <textarea class="form-control" name="long_details" id="long_details" cols="30"
                                            rows="10">{{ $products->long_details }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="box-header with-border">
                                        <i class="fa fa-check-square-o text-black"></i>
                                        <h4 class="box-title">Add Specified Product</h4>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="featured" name="featured_product" class="chk-col-primary" value="1"  {{ $products->featured_product == 1 ? 'checked' : '' }} />
                                            <label for="featured">Featured Product</label>
                                            <input type="checkbox" id="specialoffer" name="special_offer" class="chk-col-success" value="1"  {{ $products->special_offer == 1 ? 'checked' : '' }} />
                                            <label for="specialoffer">Special Offer</label>
                                            <input type="checkbox" name="special_deals" id="specialdeals" class="chk-col-info" value="1"  {{ $products->special_deals == 1 ? 'checked' : '' }} />
                                            <label for="specialdeals">Special Deals</label>
                                            <input type="checkbox" id="hotdeals" name="hotdeal_product" class="chk-col-danger" value="1"  {{ $products->hotdeal_product == 1 ? 'checked' : '' }} />
                                            <label for="hotdeals">Hot Deals</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12" id="openExDate" @if ($products->hotdeal_product == null) style="display: none" @endif>
                                    <div class="form-group">
                                        <label for="date1">Expire Offer Date :</label>
                                        <input type="date" class="form-control" id="date1" name="offer_exp_date" value="{{ $products->offer_exp_date }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Save Change">
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>

    {{-- Multiple Image Part Here --}}
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Product Image Edit</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('productimage.Store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <div class="row">
                        @foreach ( $productMultiImg as $image )
                            <div class="col-3">
                                <div class="card-group">
                                    <div class="card">
                                        <img src="{{ asset($image->image_name) }}" alt="" class="card-img-top img-thumbnail">
                                        <div class="card-body d-flex">
                                            <input type="file" name="image_name[{{ $image->id }}]" id="" class="form-control mr-2">
                                            <a href="{{ route('productimage.delete', $image->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Submit Button --}}
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-success" value="Save Change">
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('footer_js')
    <script type="text/javascript">
        // toggle
        $('#hotdeals').on("click", function() {
            $('#openExDate').slideToggle();
        })

        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        // Slug
        $('#product_name').keyup(function() {
            $('#product_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
        });

    </script>
    <script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('backend-assets/js/pages/advanced-form-element.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>

    <script>

         $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        // Multiple images preview in browser
        $(function() {
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="50" class="mr-2">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#productImage').on('change', function() {
                imagesPreview(this, 'div#image_preview');
            });
        });
        // Ajax Request For Subcateogry
        $('#category_id').change(function() {
            let category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ url('admin/subcat/ajax') }}/" + category_id,
                    success: function(data) {
                        if (data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append(
                                '<option value="">Select Subcategory One</option>');
                            $.each(data, function(key, value) {
                                $('#subcategory_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>')
                            });
                        } else {
                            $('#subcategory_id').empty();
                        }
                    }
                });
            }
        })

        // Ajax Request For Sub Subcategory
        $('#subcategory_id').change(function() {
            let subcategory_id = $(this).val();
            // alert(subcategory_id);
            if (subcategory_id) {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: "{{ url('admin/subcategory/ajax') }}/" + subcategory_id,
                    success: function(data) {
                        if (data) {
                            $('#subsubcat_id').empty();
                            $('#subsubcat_id').append(
                                '<option value="">Select Subcategory One</option>');
                            $.each(data, function(key, value) {
                                $('#subsubcat_id').append('<option value="' + value.id + '">' +
                                    value.name + '</option>')
                            });
                        } else {
                            $('#subsubcat_id').empty();
                        }
                    }
                });
            }
        })

    </script>
    {{-- CK Editor For Product Details --}}
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('long_details', options)
    </script>

@endsection
