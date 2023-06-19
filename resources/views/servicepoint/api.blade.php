@extends('layouts.app')
@section('content')

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Health Station - API :: {{ $ihos->h_name }}</h5>
                    <!-- Default Table -->
                    <table class="table table-striped table-borderless text-center" border="1">
                        <thead>
                            <tr>
                                <th scope="col">จำนวนข้อมูลผู้ป่วย</th>
                                <th scope="col">จำนวนข้อมูลการรับบริการ</th>
                                <th scope="col">จำนวนข้อมูลการให้รหัสโรค</th>
                                <th scope="col">จำนวนข้อมูลรายการตรวจรักษา</th>
                                <th scope="col">จำนวนข้อมูลรายการ LAB</th>
                                <th scope="col">ข้อมูล VisitDate ล่าสุด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ number_format($patient) }}</td>
                                <td>{{ number_format($visit) }}</td>
                                <td>{{ number_format($diag) }}</td>
                                <td>{{ number_format($drug) }}</td>
                                <td>{{ number_format($lab) }}</td>
                                <td>{{ DateThai($last) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection
