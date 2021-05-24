@extends('dinas.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">IPK III/2</h1>

    <a href="#" class="btn btn-info mb-4">Cetak Laporan</a>

    <!-- Print Modal-->
    {{-- <div class="modal fade" id="printIpk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('user.print', 'landscape') }}" method="POST">
                    @csrf
                    <div class="modal-body m-2">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="row m-3">
                            <label for="month" class="col-sm-4 col-form-label">Bulan</label>
                            <input type="month" class="form-control col-sm-6 m-0" name="month" id="month" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}


    <div class="row">
        <div class="col-lg-4">
            <!-- Basic Card Example -->
            <div class="card shadow mb-3 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Per Bulan</h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="#" method="POST">
                        @csrf
                        <label for="month" class="col-sm-3 col-form-label">Bulan</label>
                        <div class="col-auto">
                            <input type="month" class="form-control" name="month" id="month">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Basic Card Example -->
        <div class="card shadow mb-3 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan IPK III/2 Bulan {{ date('M Y', strtotime($month)) }}</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2">Jenis Pendidikan</th>
                            <th colspan="2">Sisa Bulan Yang Lalu</th>
                            <th colspan="2">Terdaftar Bulan Ini</th>
                            <th colspan="2">Penempatan Bulan Ini</th>
                            <th colspan="2">Dihapuskan Bulan Ini</th>
                            <th colspan="2">Sisa Akhir Bulan Ini</th>
                        </tr>
                        <tr>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ipk as $u)
                            <tr>
                                <td>{{ $u['education_name'] }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('rest_last_month_l') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('rest_last_month_p') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('registered_this_month_l') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('registered_this_month_p') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('placement_this_month_l') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('placement_this_month_p') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('deleted_this_month_l') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('deleted_this_month_p') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('rest_this_month_l') }}</td>
                                <td>{{ $u->where('education_id', $u['education_id'])->sum('rest_this_month_p') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
