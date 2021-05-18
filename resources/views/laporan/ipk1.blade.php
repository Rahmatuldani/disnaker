@extends('layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">IPK III/1</h1>

    <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addIpk">Tambah laporan baru</a>
    <a href="#" class="btn btn-info mb-4" data-toggle="modal" data-target="#printIpk">Cetak Laporan</a>

    <!-- Print Modal-->
    <div class="modal fade" id="printIpk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>


    <div class="row">
        <div class="col-lg-4">
            <!-- Basic Card Example -->
            <div class="card shadow mb-3 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Per Bulan</h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{ route('user.ipk1') }}" method="POST">
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
            <h6 class="m-0 font-weight-bold text-primary">Laporan IPK III/1 Bulan {{ date('M Y', strtotime($month)) }}</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="3">Pencari Kerja</th>
                        <th colspan="10">Kelompok Umur</th>
                        <th colspan="3" rowspan="2">Jumlah</th>
                        <th rowspan="4">Action</th>
                    </tr>
                    <tr>
                        <th colspan="2">15-19</th>
                        <th colspan="2">20-29</th>
                        <th colspan="2">30-44</th>
                        <th colspan="2">45-54</th>
                        <th colspan="2">55+</th>
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
                        <th>L</th>
                        <th>P</th>
                        <th>JML</th>
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
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ipk as $u)
                        <tr>
                            <td>{{ $u['ipk1_name'] }}</td>
                            <td>{{ $u['15-19l'] }}</td>
                            <td>{{ $u['15-19p'] }}</td>
                            <td>{{ $u['20-29l'] }}</td>
                            <td>{{ $u['20-29p'] }}</td>
                            <td>{{ $u['30-44l'] }}</td>
                            <td>{{ $u['30-44p'] }}</td>
                            <td>{{ $u['45-54l'] }}</td>
                            <td>{{ $u['45-54p'] }}</td>
                            <td>{{ $u['55l'] }}</td>
                            <td>{{ $u['55p'] }}</td>
                            <td>{{ $u['15-19l']+$u['20-29l']+$u['30-44l']+$u['45-54l']+$u['55l'] }}</td>
                            <td>{{ $u['15-19p']+$u['20-29p']+$u['30-44p']+$u['45-54p']+$u['55p'] }}</td>
                            <td>{{ $u['15-19l']+$u['20-29l']+$u['30-44l']+$u['45-54l']+$u['55l']+$u['15-19p']+$u['20-29p']+$u['30-44p']+$u['45-54p']+$u['55p'] }}</td>
                            <td>
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editIpk-{{$u['ipk1_id']}}"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Edit Modal-->
                        <div class="modal fade" id="editIpk-{{$u['ipk1_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$u['ipk1_name']}}?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('user.ipk1', 'edit') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="ipk1_id" value="{{$u['ipk1_id']}}">
                                            <div class="row m-3">
                                                <label for="" class="col-sm-4 col-form-label">Umur 15-19 tahun</label>
                                                <div class="col-sm">
                                                    <label for="15-19l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="15-19l" id="15-19l" value="{{$u['15-19l']}}">
                                                </div>
                                                <div class="col-sm">
                                                    <label for="15-19p" class="col-sm-6 col-form-label">Perempuan</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="15-19p" id="15-19p" value="{{$u['15-19p']}}">
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="" class="col-sm-4 col-form-label">Umur 20-29 tahun</label>
                                                <div class="col-sm">
                                                    <label for="20-29l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="20-29l" id="20-29l" value="{{$u['20-29l']}}">
                                                </div>
                                                <div class="col-sm">
                                                    <label for="20-29p" class="col-sm-6 col-form-label">Perempuan</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="20-29p" id="20-29p" value="{{$u['20-29p']}}">
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="" class="col-sm-4 col-form-label">Umur 30-44 tahun</label>
                                                <div class="col-sm">
                                                    <label for="30-44l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="30-44l" id="30-44l" value="{{$u['30-44l']}}">
                                                </div>
                                                <div class="col-sm">
                                                    <label for="30-44p" class="col-sm-6 col-form-label">Perempuan</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="30-44p" id="30-44p" value="{{$u['30-44p']}}">
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="" class="col-sm-4 col-form-label">Umur 45-54 tahun</label>
                                                <div class="col-sm">
                                                    <label for="45-54l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="45-54l" id="45-54l" value="{{$u['45-54l']}}">
                                                </div>
                                                <div class="col-sm">
                                                    <label for="45-54p" class="col-sm-6 col-form-label">Perempuan</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="45-54p" id="45-54p" value="{{$u['45-54p']}}">
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="" class="col-sm-4 col-form-label">Umur 55+ tahun</label>
                                                <div class="col-sm">
                                                    <label for="55l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="55l" id="55l" value="{{$u['55l']}}">
                                                </div>
                                                <div class="col-sm">
                                                    <label for="55p" class="col-sm-6 col-form-label">Perempuan</label>
                                                    <input type="number" class="form-control col-sm-5 m-0" name="55p" id="55p" value="{{$u['55p']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal-->
    <div class="modal fade" id="addIpk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('user.ipk1', 'add') }}" method="POST">
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
