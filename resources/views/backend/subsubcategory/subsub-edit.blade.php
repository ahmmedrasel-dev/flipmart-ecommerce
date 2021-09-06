@extends('backend.admin-master')
@section('subsubca_active')
    active
@endsection
@section('subsubca_subactive')
    active
@endsection
@section('content')
<section class="content">
    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Sub-subcategory Edit</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('subsubcategory.update', $subsubedit->id ) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 offset-md-3">
                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="category_id" id="category_id">
                                        <option selected="selected" disabled>Select Category One</option>
                                        @foreach ($categories as $category )
                                            <option value="{{ $category->id }}" @if ($subsubedit->category_id == $category->id ) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Subcategory <span class="text-danger">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="subcategory_id" id="subcategory_id">
                                        @foreach ( $subcategories as $item )
                                            <option value="{{ $item->id }}" @if ($item->id == $subsubedit->subcategory_id )
                                                selected
                                            @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Sub subcategory Name <span class="text-danger">*</span></h5>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $subsubedit->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Subcategory Slug <span class="text-danger">*</span></h5>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{ $subsubedit->slug }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Save Subcategory">
                                </div>

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
    <script>
        // Ajax Request For Subcateogry
        $('#category_id').change(function(){
            let category_id = $(this).val();
            if(category_id){
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ url('admin/subcat/ajax') }}/"+ category_id,
                    success:function(data){
                        if(data){
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value="">Select Subcategory One</option>');
                            $.each(data, function(key, value){
                                $('#subcategory_id').append('<option value="'+value.id+'">'+value.name+'</option>')
                            });
                        }else{
                            $('#subcategory_id').empty();
                        }
                    }
                });
            }
        })
    </script>
@endsection
