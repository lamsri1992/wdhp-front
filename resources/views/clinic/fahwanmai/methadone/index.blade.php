@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item active">Methadone</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-regular fa-clipboard"></i>
                        รายชื่อผู้เข้ารับการบำบัด : Methadone
                    </h5>
                    <table id="tableBasic" class="table table-borderless table-striped nowrap"
                    style="font-size: 14px;" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="1%">PATIENT : ID</th>
                                <th class="text-center">HN</th>
                                <th><i class="fa-regular fa-id-card"></i> ชื่อ-สกุล</th>
                                <th class="text-center">อายุ</th>
                                <th class="text-center">ข้อมูลการเข้ารับบำบัด</th>
                                <th class="text-center">แบบคัดกรอง และส่งต่อผู้เข้ารับบำบัด</th>
                                <th class="text-center">แบบประเมินโรคซึมเศร้า</th>
                                <th class="text-center">หน่วยบริการที่จ่ายยา</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patient as $res)
                            <tr>
                                <td class="text-center">
                                    <strong>
                                        {{ str_pad($res->patient_id, 5, '0', STR_PAD_LEFT) }}
                                    </strong>
                                </td>
                                <td class="text-center">
                                    <strong>
                                        {{ $res->patient_hn }}
                                    </strong>
                                </td>
                                <td>
                                    <div class="row">
                                        <span>
                                            {{ $res->patient_name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">{{ GetAge($res->patient_dob)." ปี" }}</td>
                                <td class="text-center">
                                    <a href="{{ route('form.info',$res->patient_id) }}" class="text-primary">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        ข้อมูลรับเข้า
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('form.screen',$res->patient_id) }}" class="text-primary">
                                        <i class="fa-regular fa-file-lines"></i>
                                        แบบคัดกรอง
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('form.depress',$res->patient_id) }}" class="text-primary">
                                        <i class="fa-regular fa-face-smile"></i>
                                        แบบประเมิน
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span>
                                        {{ $res->h_name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span>
                                        <i class="{!! $res->status_icon !!} {{ $res->status_color }}"></i>
                                        {{ $res->status_name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('met.therapy',$res->patient_id) }}" class="btn btn-circle btn-success btn-sm">
                                        <i class="fa-solid fa-address-book"></i>
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
