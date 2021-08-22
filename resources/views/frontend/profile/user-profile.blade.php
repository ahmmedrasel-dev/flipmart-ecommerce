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
                                <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action active">Profile Update</a>
                                <a href="{{ route('user.password.edit') }}" class="list-group-item list-group-item-action">Change Password</a>
                                <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-danger">Logout</a>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col col-md-10">
                    <div class="card">
                        <div class="card-body border">
                            <h4 class="card-title">Update User Information</h4>
                            <form action="{{ route('user.profile.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                                        </div>
                                    </div>

                                    <div class="col col-md-6">
                                        <div class="form-group">
                                            <label for="email">User Email</label>
                                            <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone">User Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone" value="{{ $user->phone }}">
                                </div>

                                <div class="form-group">
                                    <label for="phone">User Photo</label>
                                    <input class="form-control" type="file" name="photo" id="photo">
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
