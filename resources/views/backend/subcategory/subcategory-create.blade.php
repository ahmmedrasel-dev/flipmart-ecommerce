@extends('backend.admin-master')
@section('subca_active')
    active
@endsection
@section('subca_subactive')
    active
@endsection
@section('content')
<section class="content">
    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Subcategory Create</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6 offset-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control select2" style="width: 100%;" name="category_id">
                                            <option selected="selected" disabled>Select Category One</option>
                                            @foreach ($categories as $category )
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="form-group">
                                    <h5>Subcategory Name <span class="text-danger">*</span></h5>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Subcategory Slug <span class="text-danger">*</span></h5>
                                    <input type="text" id="slug" name="slug" class="form-control">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Save Subcategory">
                            </div>

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
         // Slug
        $('#name').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

    </script>
    <script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('backend-assets/js/pages/advanced-form-element.js') }}"></script>
@endsection
