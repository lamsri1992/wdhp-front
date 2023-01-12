@php $point = $patient->screen_1 + $patient->screen_2 + $patient->screen_3 + $patient->screen_4 + $patient->screen_5 + $patient->screen_6 @endphp
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
                        แบบคัดกรอง และส่งต่อผู้เข้ารับบำบัด : {{ $patient->patient_name }}
                    </h5>
                    @if (!isset($patient->screen_id))
                        @include('clinic.form.screen_form')
                    @else
                        @include('clinic.form.screen_data')
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
@if(!isset($patient->screen_id))
<script>
    Swal.fire({
        icon: 'error',
        title: 'ไม่พบข้อมูลการรับเข้าบำบัด',
        text: 'กรุณาบันทึกข้อมูลการรับเข้าบำบัด'
    })
</script>
@else
<script>
    Swal.fire({
        icon: 'success',
        title: 'ระดับคะแนน {{ $point }}',
        html:
            '<span class="badge bg-success"> 2-3 = ต่ำ</span> ' +
            '<span class="badge bg-warning"> 4-26 = ปานกลาง</span> ' +
            '<span class="badge bg-danger"> 27 = สูง</span> ',
    })
</script>
@endif
<script>
    $(document).ready(function(){
        $("#point").click(function(){
            Swal.fire({
                icon: 'success',
                title: 'ระดับคะแนน {{ $point }}',
                html:
                    '<span class="badge bg-success"> 2-3 = ต่ำ</span> ' +
                    '<span class="badge bg-warning"> 4-26 = ปานกลาง</span> ' +
                    '<span class="badge bg-danger"> 27 = สูง</span> ',
            })
        });
    });
</script>
@endsection
