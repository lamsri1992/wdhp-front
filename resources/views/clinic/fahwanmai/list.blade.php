@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item active">ทะเบียนผู้ป่วย</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">
                                <i class="fa-regular fa-folder-open"></i>
                                ทะเบียนผู้ป่วย
                            </h5>
                        </div>
                        <div class="col-md-6 text-end" style="margin-top: 1rem;">
                            <div class="btn-group" role="group">
                                <a href="{{ route('fah.status',base64_encode(0)) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-list"></i>
                                    ทั้งหมด
                                </a>
                                <a href="{{ route('fah.status',base64_encode(1)) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-spinner fa-spin"></i>
                                    กำลังบำบัด
                                </a>
                                <a href="{{ route('fah.status',base64_encode(3)) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-regular fa-face-smile-beam"></i>
                                    รักษาหายขาด
                                </a>
                                <a href="{{ route('fah.status',base64_encode(4)) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-user-xmark"></i>
                                    ติดตามไม่ได้
                                </a>
                                <a href="{{ route('fah.register') }}" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-user-plus"></i> ลงทะเบียนผู้ป่วย
                                </a>
                            </div>
                        </div>
                    </div>
                    <table id="tableBasic" class="table table-borderless table-striped nowrap" style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="1%">PATIENT : ID</th>
                                <th class="text-center">โปรแกรมบำบัด</th>
                                <th class="text-center">HN</th>
                                <th><i class="fa-regular fa-id-card"></i> ชื่อ-สกุล</th>
                                <th class="text-center">อายุ</th>
                                <th class="text-center">
                                    <i class="fa-regular fa-calendar-check"></i> วันที่ลงทะเบียน
                                </th>
                                <th class="text-center" width="5%">สถานะ</th>
                                <th class="text-center">
                                    <i class="fa-solid fa-bars"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patient as $res)
                            <tr>
                                <td class="text-center">
                                    {{ str_pad($res->patient_id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="text-center">
                                    <i class="{{ $res->program_icon }} text-{{ $res->program_color }}"></i>
                                    {{ $res->program_name }}
                                </td>
                                <td class="text-center">
                                    <strong>{{ $res->patient_hn }}</strong>
                                </td>
                                <td>{{ $res->patient_name }}</td>
                                <td class="text-center">{{ GetAge($res->patient_dob)." ปี" }}</td>
                                <td class="text-center">{{ DateThai($res->created_at) }}</td>
                                <td class="text-center">
                                    <strong>
                                        <small>
                                            <i class="{{ $res->status_icon." ".$res->status_color }}"></i>
                                            {{ $res->status_name }}
                                        </small>
                                    </strong>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('fah.patient',$res->patient_id) }}" class="btn btn-secondary btn-circle btn-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                </td>
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
