@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Business Field</h1>

    <a href="#" data-toggle="modal" data-target="#addBusinessField" class="btn btn-primary mb-3">Add Business Field</a>
    @if ( Session::has('message') )
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Business Field</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($business as $u)
                            <tr>
                                <td>{{ $u['business_field_id'] }}</td>
                                <td>{{ $u['business_field_name'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteBus-{{$u['business_field_id']}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>

                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteBus-{{$u['business_field_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete {{$u['business_field_name']}}?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah yakin ingin menghapus Golongan Usaha {{$u['business_field_name']}}?</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.businessField', 'delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="business_field_id" value="{{$u['business_field_id']}}">
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
    <div class="modal fade" id="addBusinessField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Business Field</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.businessField', 'add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row m-3">
                            <label for="business_field_id" class="col-sm-3 col-form-label">Code</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="business_field_id" id="business_field_id" class="form-control m-0" required>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="business_field_name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="business_field_name" id="business_field_name" class="form-control m-0" required>
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
