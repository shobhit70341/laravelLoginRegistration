@extends('layouts.app')
@section('css')
    <style type="text/css">
        #imagePreview {
        width: 200px;
        height: 200px;
        background-position: center center;
        background-size: cover;
        background-color: #f8f9fa;
        margin-top: 10px;
    }

    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">{{ __('Mobile Number') }}</label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}" required>

                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_img" class="form-label">{{ __('Profile Image') }}</label>
                            <input type="file" class="form-control @error('profile_img') is-invalid @enderror" id="profile_img" name="profile_img">

                            @error('profile_img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="imagePreview" class="mb-3">
                            @if($user->profile_img != null)
                                <img src="{{ asset('storage/' . $user->profile_img) }}" class="img-fluid">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">{{ __('Update Profile') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var profileImgInput = document.getElementById('profile_img');
        var imagePreview = document.getElementById('imagePreview');

        profileImgInput.addEventListener('change', function(e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = '<img src="' + e.target.result + '" class="img-fluid">';
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = '';
            }
        });

        // Prevent the browser from opening the dropped file directly
        document.addEventListener('drop', function(e) {
            e.preventDefault();
        });

        document.addEventListener('dragover', function(e) {
            e.preventDefault();
        });
    });
    </script>
@endsection
@endsection
