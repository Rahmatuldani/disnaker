@extends('layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    @if ( Session::has('message') )
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif

    <div class="jumbotron p-0">
        <div class="row justify-content-center">
            @if ($user['photo'] != null)
                <img class="mt-5" height="200" src="{{ asset('images/'.$user['photo']) }}" alt="">
            @else
                <img class="mt-5" height="200" src="{{ asset('img/icons/user.png') }}" alt="">
            @endif
        </div>
        <div class="row justify-content-center">
            <a href="#" class="btn btn-success m-3" data-toggle="modal" data-target="#ChangePhoto">Change Photo</a>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row m-3">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm ml-3">
                                <p id="nip" class="form-control m-0">{{ $user['nip'] }}</p>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm ml-3">
                                <p id="name" class="form-control m-0">{{ $user['name'] }}</p>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm ml-3">
                                <textarea name="address" class="form-control m-0" id="address" cols="30" rows="3" disabled>{{ $user['address'] }}</textarea>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="phone" class="col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm ml-3">
                                <p id="phone" class="form-control m-0">{{ $user['phone'] }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-end m-3">
                            <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-success mt-3">Edit</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

    <!-- Photo Modal-->
    <div class="modal fade" id="ChangePhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Photo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('user.cPhoto', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row m-2">
                            <label for="cPhoto" class="col-sm-3 col-form-label">Select a file</label>
                            <div class="col-sm-8 ml-3">
                                <input type="file" class="form-control form-control-user" id="cPhoto" name="cPhoto">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('user.update', Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row m-3">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="name" id="name" class="form-control m-0" value="{{ $user['name'] }}">
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm ml-3">
                                <textarea name="address" class="form-control m-0" id="address" cols="30" rows="3">{{ $user['address'] }}</textarea>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="phone" class="col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="phone" id="phone" class="form-control m-0" value="{{ $user['phone'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
@endsection
