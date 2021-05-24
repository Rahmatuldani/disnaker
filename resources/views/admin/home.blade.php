@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    {{-- <!-- Bar Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users based region</h6>
        </div>
        <div class="card-body" >
            <div class="chart-bar">
                <canvas id="userRegion"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users based position</h6>
        </div>
        <div class="card-body" >
            <div class="chart-bar">
                <canvas id="userPosition"></canvas>
            </div>
        </div>
    </div> --}}

</div>
<!-- /.container-fluid -->
@endsection

@push('js')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>
@endpush
