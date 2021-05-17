@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Users</h1>

    <a href="#" data-toggle="modal" data-target="#addUser" class="btn btn-primary mb-3">Add User</a>
    @if ( Session::has('message') )
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>NIP</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Photo</th>
                            <th>NIP</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($user as $u)
                            <tr>
                                <td class="row justify-content-center m-0">
                                    <img height="100" src="{{ asset('images/'.$u['photo']) }}" alt="">
                                </td>
                                <td>{{ $u['nip'] }}</td>
                                <td>{{ $u['name'] }}</td>
                                <td>{{ $u['address'] }}</td>
                                <td>{{ $u['phone'] }}</td>
                                <td>{{ $u['position_name'] }}</td>
                                <td>{{ $u['office_name'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser-{{$u['id']}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteUser-{{$u['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete {{$u['name']}}?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah yakin ingin menghapus akun {{$u['name']}}?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger" href="{{ route('user.destroy', $u['id']) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();">Delete</a>

                                            <form id="delete-form" action="{{ route('user.destroy', $u['id']) }}" method="POST" class="d-none">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal-->
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row m-3">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="nip" id="nip" class="form-control m-0" required>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="position_id" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm ml-3">
                                <input list="positionList" name="position_id" id="position_id" class="form-control" required>
                                <datalist id="positionList">
                                    @foreach ($position as $o)
                                        <option value="{{ $o['position_name'] }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="office_id" class="col-sm-3 col-form-label">Kantor</label>
                            <div class="col-sm ml-3">
                                <input list="officeList" name="office_id" id="office_id" class="form-control" required>
                                <datalist id="officeList">
                                    @foreach ($office as $o)
                                        <option value="{{ $o['office_name'] }}"></option>
                                    @endforeach
                                </datalist>
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

</div>
<!-- /.container-fluid -->
@endsection

@push('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush
