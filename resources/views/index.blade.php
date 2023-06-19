@extends('layouts.app')
@section('content')

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Health Station - API </h5>
                    <!-- Default Table -->
                    <table class="table table-striped table-borderless text-center" border="1">
                        <thead>
                            <tr>
                                <th scope="col">รหัสหน่วยบริการ</th>
                                <th scope="col">ชื่อหน่วยบริการ</th>
                                <th scope="col">ระบบ HIS</th>
                                <th scope="col">จำนวนข้อมูล (Visit)</th>
                                <th scope="col">VisitDate (ล่าสุด)</th>
                                <th scope="col">วันที่ส่งข้อมูล (ล่าสุด)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $res)
                            <tr>
                                <td>{{ $res->pcucode }}</td>
                                <td>{{ $res->h_name }}</td>
                                <td>{{ $res->h_his }}</td>
                                <td>{{ number_format($res->total) }}</td>
                                <td>{{ DateThai($res->last_visit) }}</td>
                                <td>{{ DateTimeThai($res->last_update) }}</td>
                            </tr>
                            @endforeach
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
