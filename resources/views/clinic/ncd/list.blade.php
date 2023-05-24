@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ncd.index') }}">คลินิกโรคไม่ติดต่อเรื้อรัง</a></li>
            <li class="breadcrumb-item active">ทะเบียนผู้ป่วย{{ $clinic->clinic_name }}</li>
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
                                ทะเบียนผู้ป่วย{{ $clinic->clinic_name }}
                            </h5>
                        </div>
                        <div class="col-md-6 text-end" style="margin-top: 0.8rem;">
                            <a href="#" class="btn btn-success">
                                <i class="fa-solid fa-user-plus"></i> ลงทะเบียนผู้ป่วย
                            </a>
                        </div>
                    </div>
                    <table id="tableBasic" class="table table-borderless table-striped nowrap" style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">HN</th>
                                <th><i class="fa-regular fa-id-card"></i> ชื่อ-สกุล</th>
                                <th class="text-center">อายุ</th>
                                <th class="text-center">คลินิก</th>
                                <th class="text-center">
                                    <i class="fa-regular fa-calendar-check"></i> วันที่ลงทะเบียน
                                </th>
                                <th class="text-center">
                                    <i class="fa-solid fa-bars"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $res)
                            <tr>
                                <td class="text-center">
                                    <strong>{{ $res->hcode }}</strong>
                                </td>
                                <td>{{ $res->prename.$res->fname." ".$res->lname }}</td>
                                <td class="text-center">{{ GetAge($res->birth)." ปี" }}</td>
                                <td class="text-center">
                                    {{ $res->clinic_name }}
                                </td>
                                <td class="text-center">{{ DateThai($res->regdate) }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-secondary btn-circle btn-sm">
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
