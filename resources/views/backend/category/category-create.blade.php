@extends('backend.admin-master')
@section('ca_active')
    active
@endsection
@section('ca_subactive')
    active
@endsection
@section('content')
<section class="content">
    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Category Create</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <h5>Category Name <span class="text-danger">*</span></h5>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Category Slug <span class="text-danger">*</span></h5>
                                    <input type="text" id="slug" name="slug" class="form-control">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Category Icon <span class="text-danger">Font-aswesome Icon name(*)</span></h5>
                                    <input type="text" id="icon" name="icon" class="form-control">
                                    @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Category Image Upload <span class="text-danger">*</span></h5>
                                    {{-- Preview Image --}}
                                    <div class="pb-3">
                                        <img id="showImg" class="avatar avatar-xxl avatar-bordered" src="{{ asset('backend-assets/upload-images/default_img.png') }}" alt="">
                                    </div>
                                    <div class="controls">
                                        <input id="image" type="file" name="category_image" class="form-control">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Save Category">
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
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

         // Slug
        $('#name').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

    </script>
@endsection
