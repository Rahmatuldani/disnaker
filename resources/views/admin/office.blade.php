@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Office</h1>

    <a href="#" data-toggle="modal" data-target="#addOffice" class="btn btn-primary mb-3">Add Office</a>
    @if ( Session::has('message') )
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Office</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($office as $u)
                            <tr>
                                <td>{{ $u['office_name'] }}</td>
                                <td>{{ $u['office_address'] }}</td>
                                <td>{{ $u['town_slug'].' '.$u['town_name'] }}</td>
                                <td>{{ $u['office_phone'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editOffice-{{$u['office_id']}}"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteOffice-{{$u['office_id']}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editOffice-{{$u['office_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit {{$u['office_name']}}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.office', 'edit') }}" method="POST">
                                            @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="office_id" value="{{$u['office_id']}}">
                                            <div class="row m-3">
                                                <label for="office_name" class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm ml-3">
                                                    <input type="text" name="office_name" id="office_name" class="form-control m-0" value="{{$u['office_name']}}" required>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="office_address" class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm ml-3">
                                                    <textarea name="office_address" id="office_address" cols="30" rows="3" class="form-control m-0" required>{{$u['office_address']}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="office_phone" class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm ml-3">
                                                    <input type="text" name="office_phone" id="office_phone" class="form-control m-0" value="{{$u['office_phone']}}"  required>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="town_id" class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm ml-3">
                                                    <input list="townList" name="town_id" id="town_id" class="form-control" value="{{$u['town_slug'].' '.$u['town_name']}}" required>
                                                    <datalist id="townList">
                                                        @foreach ($town as $t)
                                                            <option value="{{ $t['town_slug'].' '.$t['town_name'] }}"></option>
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

                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteOffice-{{$u['office_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete {{$u['office_name']}}?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah yakin ingin menghapus Kantor {{$u['office_name']}}?</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.office', 'delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="office_id" value="{{$u['office_id']}}">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
    <div class="modal fade" id="addOffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Office</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.office', 'add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row m-3">
                            <label for="office_name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="office_name" id="office_name" class="form-control m-0" required>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="office_address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm ml-3">
                                <textarea name="office_address" id="office_address" cols="30" rows="3" class="form-control m-0" required></textarea>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="office_phone" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="office_phone" id="office_phone" class="form-control m-0" required>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="town_id" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm ml-3">
                                <input list="townList" name="town_id" id="town_id" class="form-control" required>
                                <datalist id="townList">
                                    @foreach ($town as $t)
                                        <option value="{{ $t['town_slug'].' '.$t['town_name'] }}"></option>
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
