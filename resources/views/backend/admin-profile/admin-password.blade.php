@extends('backend.admin-master')
@section('content')
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Password Changes</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('admin.password.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Admin Current Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" id="current_password" name="oldpassword" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Admin New Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password"  id="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Admin Confirm Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
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
