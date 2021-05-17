@extends('layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Change Password</h1>

    <div class="jumbotron">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Basic Card Example -->
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('user.cpass', Auth::user()->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row m-3">
                                <label for="current_password" class="col-sm-4 col-form-label">Current Password</label>
                                <div class="col-sm ml-2">
                                    <input type="password" class="form-control m-0 @error('current_password') is-invalid @enderror" name="current_password" id="current_password">
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row m-3">
                                <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm ml-2">
                                    <input type="password" class="form-control m-0 @error('new_password') is-invalid @enderror" name="new_password" id="new_password">
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row m-3">
                                <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm ml-2">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control m-0 @error('confirm_password') is-invalid @enderror">
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end m-3">
                                <button type="submit" class="btn btn-success mt-3">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
