@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="#">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="col-lg-12">
        <div class="row">
            <!-- Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">ผู้เข้ารับการบำบัดทั้งหมด</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-clipboard-list text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($all) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">ผู้ที่เข้ารับการบำบัดสำเร็จ</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-clipboard-check text-success"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($finish) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">ผู้ที่อยู่ระหว่างการบำบัด</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-spinner fa-spin text-info"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($progress) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Lost Follow-up</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-user-slash text-danger"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($lost) }} ราย</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</section>

<section class="section">
    <div class="row align-items-top">
        <div class="col-lg-6">
            <!--  Card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-chart-bar"></i>
                        จำนวนผู้ป่วยแยกตามตำบล
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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-chart-bar"></i>
                        จำนวนผู้ป่วยแยกตามหมู่บ้าน
                    </h5>
                    <div class="card-body">
                        <canvas id="homeChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-lg-6">
            <!--  Card -->
            <div class="card" style="height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-hospital-user"></i>
                        จำนวนผู้ป่วยแยกตามคลินิก
                    </h5>
                    <div class="card-body">
                        @foreach ($count as $counts)                        
                        <h4 class="small font-weight-bold">Matrix Program <span class="float-right">{{ $counts->mtx }} ราย</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $counts->mtx }}%" aria-valuenow="{{ $counts->mtx }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <h4 class="small font-weight-bold">Methadone <span class="float-right">{{ $counts->mtd }} ราย</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $counts->mtd }}%" aria-valuenow="{{ $counts->mtd }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <h4 class="small font-weight-bold">โปรแกรมเลิกสุรา <span class="float-right">0 ราย</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <h4 class="small font-weight-bold">โปรแกรมเลิกบุหรี่ <span class="float-right">0 ราย</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-lg-6">
            <!--  Card -->
            <div class="card" style="height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-calendar-check"></i>
                        ตารางออกหน่วยบริการ
                    </h5>
                    <div class="card-body">
                       <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">หน่วยบริการ</th>
                                <th scope="col" class="text-center">วันที่ไปล่าสุด</th>
                                <th scope="col" class="text-center">วันที่นัดหมาย</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>รพ.สต.แม่ตะละ</td>
                                <td class="text-center">2566-01-01</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                            <tr>
                                <td>รพ.สต.แม่แดด</td>
                                <td class="text-center">2566-01-01</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                            <tr>
                                <td>รพ.สต.ห้วยบง</td>
                                <td class="text-center">2566-01-01</td>
                                <td class="text-center">2566-06-11</td>
                            </tr>
                            <tr>
                                <td>รพ.สต.แม่ละอูป</td>
                                <td class="text-center">2566-01-01</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                            <tr>
                                <td>สสช.ขุนแม่รวม</td>
                                <td class="text-center">2566-01-01</td>
                                <td class="text-center">2566-01-01</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
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
        @foreach ($district as $res)
        [ "{{ $res->tname }}"],
        @endforeach
    ];
  
    const config = {
      type: 'bar',
      data: {
        datasets: [{
            label: 'จำนวน/คน',
            data: [
                @foreach ($district as $res)
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
    // MOO
    const labels2 = [
        @foreach ($mooname as $res)
        [ "{{ $res->mooname }}"],
        @endforeach
    ];
  
    const config2 = {
      type: 'bar',
      data: {
        datasets: [{
            label: 'จำนวน/คน',
            data: [
                @foreach ($mooname as $res)
                "{{ $res->total }}",
                @endforeach
            ],
            backgroundColor: [
                '#f6c23ecf',
            ],
            borderColor: [
                '#f6c23ecf',
            ],
        }],
        labels: labels2
    },
      options: {}
    };

    const homeChart = new Chart(
        document.getElementById('homeChart'),
        config2
    );
</script>
@endsection
