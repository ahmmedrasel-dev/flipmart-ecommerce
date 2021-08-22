@extends('frontend.front-master')
@section('content')
<div class="container">
    <div class="sign-in-page">
        <div class="card-body">
            <div class="row">
                <div class="col col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <img class="img-fluid img-thumbnail" src="{{ ( !empty($user->profile_photo_path)) ?  url('front-assets/images/profile_photo/'.$user->profile_photo_path): url('backend-assets/profile_photo/default/default_img.png') }}" alt="" style="border-radius: 50%">
                            <ul class="list-group" style="margin-top:20px">
                                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                                <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">Profile Update</a>
                                <a href="{{ route('user.password.edit') }}" class="list-group-item list-group-item-action active">Change Password</a>
                                <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-danger">Logout</a>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col col-md-10">
                    <div class="card">
                        <div class="card-body border">
                            <h4 class="card-title">Change User Password</h4>
                            <form action="{{ route('user.password.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="oldpassword">Current Password</label>
                                    <input class="form-control" type="password" name="oldpassword" id="oldpassword">
                                </div>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input class="form-control" type="password" name="password" id="password">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                                </div>

                                <button class="btn btn-success" type="submit" name="action">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- // end col md 6 -->

            </div> <!-- // end row -->
        </div>
    </div>
</div>
@endsection
