@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <nav style="--bs-breadcrumb-divider: '-';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ระบบคลินิก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.index') }}">คลินิกฟ้าวันใหม่</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fah.list') }}">ทะเบียนผู้ป่วย</a></li>
            <li class="breadcrumb-item active">ข้อมูลการรับเข้าบำบัด</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-pen-to-square"></i>
                        ข้อมูลการรับเข้าบำบัด : {{ $patient->patient_name }}
                    </h5>
                    @if (!isset($patient->info_id))
                        @include('clinic.form.info_form')
                    @else
                        @include('clinic.form.info_data')
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="text-center">
        <a href="{{ route('form.info',$patient->patient_id) }}" class="btn btn-outline-dark">
            <i class="fa-regular fa-pen-to-square"></i>
            ข้อมูลรับเข้า
        </a>
        <a href="{{ route('form.screen',$patient->patient_id) }}" class="btn btn-outline-dark">
            <i class="fa-regular fa-file-lines"></i>
            แบบคัดกรอง
        </a>
        <a href="{{ route('form.depress',$patient->patient_id) }}" class="btn btn-outline-dark">
            <i class="fa-regular fa-face-smile"></i>
            แบบประเมิน
        </a>
    </div>
</section>
@endsection
@section('script')
@if(!isset($patient->info_id))
<script>
    Swal.fire({
        icon: 'error',
        title: 'ไม่พบข้อมูลการรับเข้าบำบัด',
        text: 'กรุณาบันทึกข้อมูลการรับเข้าบำบัด'
    })
</script>
@endif
@endsection
