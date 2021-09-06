@extends('backend.admin-master')
@section('b_active')
    active
@endsection
@section('b_subactive')
    active
@endsection
@section('content')
<section class="content">
    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Brand Edit</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('brand.update', $brands->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <h5>Brand Name <span class="text-danger">*</span></h5>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $brands->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Brand Slug <span class="text-danger">*</span></h5>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{ $brands->slug }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Brand Image Upload <span class="text-danger">*</span></h5>
                                    {{-- Preview Image --}}
                                    <div class="pb-3">
                                        <img id="showImg" class="avatar avatar-xxl avatar-bordered" src="{{ asset('backend-assets/upload-images/brand/'.$brands->image ) }}" alt="{{ $brands->name }}">
                                    </div>
                                    <div class="controls">
                                        <input id="image" type="file" name="brand_image" class="form-control">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

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
