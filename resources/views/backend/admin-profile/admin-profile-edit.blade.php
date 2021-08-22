@extends('backend.admin-master')
@section('content')
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Information Edit</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Admin Full Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" value="{{ $adminProfile->name }}" required >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Admin Email Address <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control" value="{{ $adminProfile->email }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Profile Photo Upload <span class="text-danger">*</span></h5>
                                        {{-- Preview Image --}}
                                        <div class="pb-3">
                                            <img id="showImg" class="avatar avatar-xxl avatar-bordered" src="{{ ( !empty($adminProfile->profile_photo_path)) ?  url('backend-assets/profile_photo/'.$adminProfile->profile_photo_path): url('backend-assets/profile_photo/default/default_img.png') }}" alt="">
                                        </div>
                                        <div class="controls">
                                            <input id="image" type="file" name="profile_photo" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Save Change</button>
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
    </script>
@endsection
