@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="#">คลินิกโรคไม่ติดต่อเรื้อรัง</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row align-items-top">
        <div class="col-lg-6">
            <!--  Card -->
            <div class="card" style="height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-chart-bar"></i>
                        จำนวนผู้ป่วยแยกคลินิก
                    </h5>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-lg-6">
            <!--  Card -->
            <div class="card" style="height: 100%;">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <div class="card-body">
                        <ol class="list-group">
                            @foreach ($data as $res)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="">คลินิก</div>
                                    <div class="fw-bold">
                                        @if (Auth::user()->pcucode == '23736')
                                        <a href="{{ route('ncd.all',$res->clinic_id) }}">
                                            {{ $res->clinic_name }}
                                        </a>
                                        @else
                                        <a href="{{ route('ncd.list',$res->clinic_id) }}">
                                            {{ $res->clinic_name }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <span class="badge bg-danger rounded-pill" style="width: 5rem;">{{ number_format($res->total) }}</span>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    const labels = [
        @foreach ($data as $res)
        [ "{{ $res->clinic_name }}"],
        @endforeach
    ];
  
    const config = {
      type: 'bar',
      data: {
        datasets: [{
            label: 'จำนวน/คน',
            data: [
                @foreach ($data as $res)
                "{{ $res->total }}",
                @endforeach
            ],
            backgroundColor: [
                '#6f42c1c4',
            ],
            borderColor: [
                '#6f42c1c4',
            ],
        }],
        labels: labels
    },
      options: {}
    };

    $(document).ready(function () {
        Chart.defaults.font.family = 'Prompt';
    });

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
@endsection
