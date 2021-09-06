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
                <h4 class="box-title">Product Create</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    {{-- Product Name --}}
                                    <div class="form-group">
                                        <h5>Product Name<span class="text-danger">*</span></h5>
                                        <input type="text" id="product_name" name="product_name" class="form-control"
                                            value="{{ old('product_name') }}">
                                        @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Product Slug --}}
                                    <div class="form-group">
                                        <h5>Product Slug<span class="text-danger">*</span></h5>
                                        <input type="text" id="product_slug" name="product_slug" class="form-control"
                                            value="{{ old('product_slug') }}">
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
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                            id="subcategory_id"> </select>
                                        @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Product Sub Sub Category --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Select Sub subcategory Name <span class="text-danger">*</span></h5>
                                        <select class="form-control select2" style="width: 100%;" name="subsubcategory_id"
                                            id="subsubcat_id"></select>
                                        @error('subsubcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Product Brand --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Select Brand <span class="text-danger">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="brand_id"
                                            id="brand_id">
                                            <option selected="selected" disabled>Select Brand One</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
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
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Tag<span class="text-danger">*</span></h5>
                                        <select multiple data-role="tagsinput" name="product_tag[]"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Code<span class="text-danger">*</span></h5>
                                        <input type="text" name="product_code" id="product_code" class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Quantity<span class="text-danger">*</span></h5>
                                        <input type="text" name="product_qty" id="product_qty" class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                        <input type="text" name="selling_price" id="selling_price" class="form-control">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                        <input type="text" name="descount_price" id="descount_price" class="form-control">
                                    </div>
                                </div>
                            </div>

                             {{-- Product Attribute Add --}}
                             <div id="dynamic-field-1" class="form-group dynamic-field">
                                <div class="row">
                                    {{-- Product Attribute Name --}}
                                    <div class="col-6">
                                        <label for="field" class="font-weight-bold">Attribute Name</label>
                                        <select name="attribute_id[]" id="attribute_id" class="form-control @error('attribute_id') is-invalid @enderror">
                                            <option value="" disabled selected>Select Attribute</option>
                                           @foreach ($attributesetnames as $item)
                                            <option value="{{ $item->id }}">{{ ucwords($item->attribute_name) }}</option>
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
                                            <option value="{{ $item->id }}">{{ $item->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Add Remove Button to Muliple Variation Product --}}
                            <div class="clearfix form-group mt-4">
                                <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus"></i> Add</button>
                                <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus"></i> Remove</button>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <img id="showImg" src="" alt="" style="width: 50px">
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
                                        <h5>Product Multi Image <span class="text-danger">*</span></h5>
                                        <div id="image_preview"></div>
                                        <div class="controls">
                                            <input  multiple type="file" name="image_name[]" id="productImage" class="form-control" onchange="preview_image()">
                                            @error('image_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Product Details<span class="text-danger">*</span></h5>
                                        <textarea class="form-control" name="long_details" id="long_details" cols="30"
                                            rows="10"></textarea>
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
                                            <input type="checkbox" id="featured" name="featured_product" class="chk-col-primary" value="1" />
                                            <label for="featured">Featured Product</label>
                                            <input type="checkbox" id="specialoffer" name="special_offer" class="chk-col-success" value="1" />
                                            <label for="specialoffer">Special Offer</label>
                                            <input type="checkbox" name="special_deals" id="specialdeals" class="chk-col-info" value="1" />
                                            <label for="specialdeals">Special Deals</label>
                                            <input type="checkbox" id="hotdeals" name="hotdeal_product" class="chk-col-danger" value="1" />
                                            <label for="hotdeals">Hot Deals</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Save Subcategory">
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
@endsection
@section('footer_js')
    <script type="text/javascript">
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

    <script type="text/javascript">
        // Add Remove field.
        var buttonAdd = $("#add-button");
        var buttonRemove = $("#remove-button");
        var className = ".dynamic-field";
        var count = 0;
        var field = "";
        var maxFields = 5;

        function totalFields() {
            return $(className).length;
        }

        function addNewField() {
            count = totalFields() + 1;
            field = $("#dynamic-field-1").clone();
            field.attr("id", "dynamic-field-" + count);
            field.children("label").text("Field " + count);
            field.find("input").val("");
            $(className + ":last").after($(field));
        }

        function removeLastField() {
            if (totalFields() > 1) {
            $(className + ":last").remove();
            }
        }

        function enableButtonRemove() {
            if (totalFields() === 2) {
            buttonRemove.removeAttr("disabled");
            buttonRemove.addClass("shadow-sm");
            }
        }

        function disableButtonRemove() {
            if (totalFields() === 1) {
            buttonRemove.attr("disabled", "disabled");
            buttonRemove.removeClass("shadow-sm");
            }
        }

        function disableButtonAdd() {
            if (totalFields() === maxFields) {
            buttonAdd.attr("disabled", "disabled");
            buttonAdd.removeClass("shadow-sm");
            }
        }

        function enableButtonAdd() {
            if (totalFields() === (maxFields - 1)) {
            buttonAdd.removeAttr("disabled");
            buttonAdd.addClass("shadow-sm");
            }
        }

        buttonAdd.click(function() {
            addNewField();
            enableButtonRemove();
            disableButtonAdd();
        });

        buttonRemove.click(function() {
            removeLastField();
            disableButtonRemove();
            enableButtonAdd();
        });
    </script>

@endsection
